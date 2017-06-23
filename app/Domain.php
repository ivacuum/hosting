<?php namespace App;

use App\Events\DomainWhoisUpdated;
use Carbon\Carbon;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Домен
 *
 * @property integer $id
 * @property integer $alias_id
 * @property integer $client_id
 * @property integer $yandex_user_id
 * @property string  $domain
 * @property integer $status
 * @property integer $domain_control
 * @property integer $orphan
 * @property string  $ipv4
 * @property string  $ipv6
 * @property string  $mx
 * @property string  $ns
 * @property string  $text
 * @property string  $cms_type
 * @property string  $cms_version
 * @property string  $cms_url
 * @property string  $cms_user
 * @property string  $cms_pass
 * @property string  $ftp_host
 * @property string  $ftp_user
 * @property string  $ftp_pass
 * @property string  $ssh_host
 * @property string  $ssh_user
 * @property string  $ssh_pass
 * @property string  $db_pma
 * @property string  $db_host
 * @property string  $db_user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $registered_at
 * @property \Carbon\Carbon $paid_till
 * @property \Carbon\Carbon $queried_at
 *
 * @mixin \Eloquent
 */
class Domain extends Model
{
    const REGRU_API_URL = 'https://api.reg.ru/api/regru2/';
    const NS0 = 'dns1.yandex.net';
    const NS1 = 'dns2.yandex.net';

    protected $guarded = ['created_at', 'updated_at', 'raw'];
    protected $hidden = ['cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass'];
    protected $dates = ['mailed_at', 'queried_at', 'registered_at', 'paid_till'];
    protected $perPage = 50;

    // Internal
    public function getRouteKeyName()
    {
        return 'domain';
    }

    // Relations
    public function alias()
    {
        return $this->belongsTo(Domain::class);
    }

    public function aliases()
    {
        return $this->hasMany(self::class, 'alias_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function yandexUser()
    {
        return $this->belongsTo(YandexUser::class);
    }

    // Events
    public static function boot()
    {
        parent::boot();

        // Домен перестает быть алиасом для других
        static::deleted(function (Domain $domain) {
            $domain->where('alias_id', $domain->id)
                ->update(['alias_id' => 0]);
        });
    }

    // Scopes
    public function scopeYandexReady(Builder $query, $user_id = 0)
    {
        return $query->where('status', 1)
            ->whereIn('yandex_user_id', [0, $user_id])
            ->orderBy('domain');
    }

    public function scopeWhoisReady(Builder $query)
    {
        return $query->where('status', 1)
            ->where('queried_at', '<', (string) Carbon::now()->subHours(3));
    }

    // Methods
    public function addMailbox($login, $password)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();
        $domain = $this->domain;

        $response = $client->post('admin/email/add', [
            'query' => compact('domain', 'login', 'password'),
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    /**
     * Добавление днс-записей через API Яндекса
     *
     * @param  string $type
     * @param  array  $input
     * @return string
     * @throws \Exception
     */
    public function addNsRecord($type, array $input)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $allowed_types = ['A', 'AAAA', 'CNAME', 'MX', 'NS', 'SRV', 'TXT'];

        if (!in_array($type, $allowed_types)) {
            throw new \Exception('Неподдерживаемый тип записи');
        }

        // content, subdomain, priority, port, weight
        $content = '@' === $input['content'] ? $this->domain : $input['content'];

        $client = $this->getYandexPddApiClient();

        $response = $client->post('admin/dns/add', [
            'query' => [
                'type' => $type,
                'port' => $input['port'] ?? '',
                'domain' => $this->domain,
                'weight' => $input['weight'] ?? '',
                'target' => idn_to_ascii($content),
                'content' => idn_to_ascii($content),
                'priority' => $input['priority'] ?? '',
                'subdomain' => $input['subdomain'],
            ],
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    public function breadcrumb()
    {
        return $this->domain;
    }

    /**
     * Удаление днс-записей через API Яндекса
     *
     * @param  integer $record_id
     * @return string
     * @throws \Exception
     */
    public function deleteNsRecord($record_id)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();
        $domain = $this->domain;

        $response = $client->post('admin/dns/del', [
            'query' => compact('domain', 'record_id'),
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    public function dkimSecretKey()
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->get("admin/dkim/status?domain={$this->domain}&secretkey=yes");
        $json = json_decode($response->getBody());

        if ('ok' !== $json->success) {
            throw new \Exception("Api error: {$json->error}");
        }

        return $json;
    }

    /**
     * Редактирование днс-записей через API Яндекса
     *
     * @param  integer $id
     * @param  string  $type
     * @param  array   $input
     * @return string
     * @throws \Exception
     */
    public function editNsRecord($id, $type, array $input)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $allowed_types = ['A', 'AAAA', 'CNAME', 'MX', 'NS', 'SOA', 'SRV', 'TXT'];

        if (!in_array($type, $allowed_types)) {
            throw new \Exception('Неподдерживаемый тип записи');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->post('admin/dns/edit', [
            'query' => [
                'ttl' => $input['ttl'] ?? '',
                'port' => $input['port'] ?? '',
                'retry' => $input['retry'] ?? '',
                'expire' => $input['expire'] ?? '',
                'domain' => $this->domain,
                'target' => idn_to_ascii($input['content']),
                'weight' => $input['weight'] ?? '',
                'content' => idn_to_ascii($input['content']),
                'refresh' => $input['refresh'] ?? '',
                'priority' => $input['priority'] ?? '',
                'subdomain' => $input['subdomain'],
                'record_id' => $id,
            ],
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    public function getMailboxes()
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->get("admin/email/list?domain={$this->domain}");
        $json = json_decode($response->getBody());

        if ('ok' !== $json->success) {
            throw new \Exception("Api error: {$json->error}");
        }

        usort($json->accounts, function ($a, $b) {
            return strnatcmp($a->login, $b->login);
        });

        return $json;
    }

    /**
    * Какие домены прописаны в панели reg.ru
    */
    public function getNsServers()
    {
        $client = $this->getRegRuApiClient();

        $domain_name = $this->domain;
        $params = compact('domain_name');

        $response = $client->get('domain/get_nss', ['query' => $params]);

        $json = json_decode($response->getBody());

        $ns = [];

        foreach ($json->answer->domains[0]->nss as $row) {
            $ns[] = $row->ns;
        }

        return $ns;
    }

    public function getNsRecords()
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->get("admin/dns/list?domain={$this->domain}");
        $json = json_decode($response->getBody());

        if ('ok' !== $json->success) {
            throw new \Exception("Api error: {$json->error}");
        }

        $sort = [];
        foreach ($json->records as $key => $record) {
            $sort['type'][$key] = $record->type;
            $sort['subdomain'][$key] = $record->subdomain;
        }

        if (!empty($sort)) {
            array_multisort($sort['type'], SORT_STRING, $sort['subdomain'], SORT_STRING, $json->records);
        }

        return $json->records;
    }

    public function getPddStatus()
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->get("admin/domain/registration_status?domain={$this->domain}");

        return json_decode($response->getBody());
    }

    public function getRobotsTxt()
    {
        $client = new HttpClient;
        $domain = idn_to_ascii($this->domain);

        try {
            $response = $client->get("http://{$domain}/robots.txt");
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $response->getBody();
    }

    public function getWhoisData()
    {
        $query = new WhoisQuery($this->domain);

        return $query->getRaw();
    }

    public function getWhoisParsedData()
    {
        $query = new WhoisQuery($this->domain);
        $data = array_merge($query->parse(), $query->getDnsRecords());

        // whois failed
        if (empty($data['registered_at'])) {
            return [];
        }

        $data['registered_at'] = Carbon::parse($data['registered_at']);
        $data['paid_till'] = Carbon::parse($data['paid_till']);
        $data['queried_at'] = Carbon::now();
        $data['raw'] = $query->getRaw();

        return $data;
    }

    public function isExpired()
    {
        return $this->paid_till->year > 1970 && ($this->paid_till->isPast() || false !== strpos($this->ns, 'expired.reg.ru'));
    }

    public function isExpiringSoon()
    {
        return $this->paid_till->isFuture() && $this->paid_till->diffInDays() < 30;
    }

    public function isIdn($domain = '')
    {
        $domain = $domain ?: $this->domain;

        return 0 === strpos($domain, 'xn--');
    }

    public function setServerNsRecords($server)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        switch ($server) {
            case 'srv1.korden.net': $ipv4 = '62.109.0.61';     $ipv6 = '2a01:230:2::1fb'; break;
            case 'srv2.korden.net': $ipv4 = '188.120.229.204'; $ipv6 = '2a01:230:2::1fc'; break;
            case 'srv3.korden.net': $ipv4 = '62.109.4.161';    $ipv6 = '2a01:230:2::1fd'; break;
            case 'srv4.korden.net': $ipv4 = '62.109.6.149';    $ipv6 = '2a01:230:2::e2'; break;
            case 'bsd.korden.net':  $ipv4 = '31.200.207.80';   $ipv6 = ''; break;
            case 'srv1.ivacuum.ru': $ipv4 = '82.146.36.248';   $ipv6 = '2a01:230:2:6::16c'; break;
            case 'srv2.ivacuum.ru': $ipv4 = '93.81.237.72';    $ipv6 = ''; break;
            default: $ipv4 = $ipv6 = '';
        }

        if ($ipv4) {
            $this->addNsRecord('A', ['content' => $ipv4, 'subdomain' => '@']);
        }
        if ($ipv6) {
            $this->addNsRecord('AAAA', ['content' => $ipv6, 'subdomain' => '@']);
        }

        $this->addNsRecord('CNAME', ['content' => '@', 'subdomain' => '*']);

        return true;
    }

    public function setYandexPdd()
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->post('admin/domain/register', [
            'query' => [
                'domain' => $this->domain,
            ],
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    public function setYandexNs()
    {
        $client = $this->getRegRuApiClient();

        $response = $client->get('domain/update_nss', [
            'query' => [
                'dname' => $this->domain,
                'ns0'   => self::NS0,
                'ns1'   => self::NS1,
            ],
        ]);

        $json = json_decode($response->getBody());

        $status = $json->answer->domains[0]->result;

        if ('success' != $status) {
            \Log::error('Unable to set yandex ns servers via reg.ru api', [
                'context' => $response
            ]);
        }

        return $status;
    }

    public function updateWhois()
    {
        if (empty($data = $this->getWhoisParsedData())) {
            return false;
        }

        if ($this->isExpired()) {
            // unset($data['paid_till']);
        }

        event(new DomainWhoisUpdated($this, $data));

        $this->update($data);

        return true;
    }

    public function whatServerIpv4()
    {
        switch ($this->ipv4) {
            case '62.109.0.61': return 'srv1.korden.net';
            case '188.120.229.204': return 'srv2.korden.net';
            case '62.109.4.161': return 'srv3.korden.net';
            case '62.109.6.149': return 'srv4.korden.net';

            case '93.81.237.72': return 'srv2.ivacuum.ru';

            case '77.221.130.18': return 'srv018.infobox.ru';
            case '77.221.130.22': return 'srv022.infobox.ru';
            case '77.221.130.25': return 'srv025.infobox.ru';
            case '77.221.130.41': return 'srv041.infobox.ru';

            case '77.222.56.62': return 'vh213.sweb.ru';
        }

        return str_replace(' ', '<br>', $this->ipv4);
    }

    public function firstNsServer()
    {
        return explode(' ', $this->ns)[0];
    }

    protected function getRegRuApiClient()
    {
        return new HttpClient([
            'base_uri' => self::REGRU_API_URL,
            'query' => [
                'username' => env('REGRU_USER'),
                'password' => env('REGRU_PASS'),
            ],
        ]);
    }

    protected function getYandexPddApiClient()
    {
        static $client;

        if (empty($client)) {
            $client = new HttpClient([
                'base_uri' => 'https://pddimp.yandex.ru/api2/',
                'headers' => ['PddToken' => $this->yandexUser->token],
            ]);
        }

        return $client;
    }
}
