<?php namespace App;

use Carbon\CarbonImmutable;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $alias_id
 * @property int $client_id
 * @property int $yandex_user_id
 * @property string $domain
 * @property int $status
 * @property int $domain_control
 * @property int $orphan
 * @property string $ipv4
 * @property string $ipv6
 * @property string $mx
 * @property string $ns
 * @property string $text
 * @property string $cms_type
 * @property string $cms_version
 * @property string $cms_url
 * @property string $cms_user
 * @property string $cms_pass
 * @property string $ftp_host
 * @property string $ftp_user
 * @property string $ftp_pass
 * @property string $ssh_host
 * @property string $ssh_user
 * @property string $ssh_pass
 * @property string $db_pma
 * @property string $db_host
 * @property string $db_user
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $registered_at
 * @property \Carbon\CarbonImmutable $paid_till
 * @property \Carbon\CarbonImmutable $queried_at
 *
 * @property YandexUser $yandexUser
 *
 * @mixin \Eloquent
 */
class Domain extends Model
{
    const REGRU_API_URL = 'https://api.reg.ru/api/regru2/';
    const NS0 = 'dns1.yandex.net';
    const NS1 = 'dns2.yandex.net';

    protected $guarded = ['created_at', 'updated_at', 'raw', 'goto'];
    protected $hidden = ['cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass'];
    protected $dates = ['mailed_at', 'queried_at', 'registered_at', 'paid_till'];
    protected $perPage = 50;

    protected $casts = [
        'orphan' => 'int',
        'status' => 'int',
        'alias_id' => 'int',
        'client_id' => 'int',
        'domain_control' => 'int',
        'yandex_user_id' => 'int',
    ];

    // Internal
    public function getRouteKeyName()
    {
        return 'domain';
    }

    // Relations
    public function alias()
    {
        return $this->belongsTo(static::class);
    }

    public function aliases()
    {
        return $this->hasMany(static::class, 'alias_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function yandexUser()
    {
        return $this->belongsTo(YandexUser::class);
    }

    // Scopes
    public function scopeYandexReady(Builder $query, int $userId = null)
    {
        $query->where('status', 1)
            ->orderBy('domain');

        return $userId === null
            ? $query->where('yandex_user_id', 0)
            : $query->whereIn('yandex_user_id', [0, $userId]);
    }

    public function scopeWhoisReady(Builder $query)
    {
        return $query->where('status', 1)
            ->where('queried_at', '<', (string) now()->subHours(3));
    }

    // Methods
    public function addMailbox($login, $password)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->post('admin/email/add', [
            'query' => [
                'login' => $login,
                'domain' => $this->domain,
                'password' => $password,
            ],
        ]);

        $json = json_decode($response->getBody());

        return 'ok' !== $json->success ? $json->error : 'ok';
    }

    /**
     * Добавление днс-записей через API Яндекса
     */
    public function addNsRecord(string $type, array $input)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $allowedTypes = ['A', 'AAAA', 'CNAME', 'MX', 'NS', 'SRV', 'TXT'];

        if (!in_array($type, $allowedTypes)) {
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
                'target' => idn_to_ascii($content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46),
                'content' => !in_array($type, ['A', 'AAAA', 'TXT'])
                    ? idn_to_ascii($content, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46)
                    : $content,
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

    public function deleteNsRecord(int $recordId): string
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $client = $this->getYandexPddApiClient();

        $response = $client->post('admin/dns/del', [
            'query' => [
                'domain' => $this->domain,
                'record_id' => $recordId,
            ],
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
     */
    public function editNsRecord(int $id, string $type, array $input)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        $allowedTypes = ['A', 'AAAA', 'CNAME', 'MX', 'NS', 'SOA', 'SRV', 'TXT'];

        if (!in_array($type, $allowedTypes)) {
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
                'target' => idn_to_ascii($input['content'], IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46),
                'weight' => $input['weight'] ?? '',
                'content' => !in_array($type, ['A', 'AAAA', 'TXT'])
                    ? idn_to_ascii($input['content'], IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46)
                    : $input['content'],
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

        usort($json->accounts, fn ($a, $b) => strnatcmp($a->login, $b->login));

        return $json;
    }

    /**
     * Какие домены прописаны в панели reg.ru
     */
    public function getNsServers()
    {
        $client = $this->getRegRuApiClient();

        $response = $client->get('domain/get_nss', ['query' => ['domain_name' => $this->domain]]);

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
        $domain = idn_to_ascii($this->domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);

        try {
            $response = $client->get("http://{$domain}/robots.txt");
        } catch (\Throwable $e) {
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

        $data['registered_at'] = CarbonImmutable::parse($data['registered_at']);
        $data['paid_till'] = CarbonImmutable::parse($data['paid_till']);
        $data['queried_at'] = now();
        $data['raw'] = $query->getRaw();

        return $data;
    }

    public function isExpired()
    {
        return $this->paid_till->year > 1970
            && ($this->paid_till->isPast() || str_contains($this->ns, 'expired.reg.ru'));
    }

    public function isExpiringSoon()
    {
        return $this->paid_till->isFuture() && $this->paid_till->diffInDays() < 30;
    }

    public function isIdn($domain = '')
    {
        $domain = $domain ?: $this->domain;

        return str_starts_with($domain, 'xn--');
    }

    public function setServerNsRecords($server)
    {
        if (!$this->yandex_user_id) {
            throw new \Exception('Домен не связан с учеткой в Яндексе');
        }

        switch ($server) {
            case 'srv1.korden.net':
                $ipv4 = '62.109.0.61';
                $ipv6 = '2a01:230:2::1fb';
                break;
            case 'srv2.korden.net':
                $ipv4 = '188.120.229.204';
                $ipv6 = '2a01:230:2::1fc';
                break;
            case 'srv3.korden.net':
                $ipv4 = '62.109.4.161';
                $ipv6 = '2a01:230:2::1fd';
                break;
            case 'srv4.korden.net':
                $ipv4 = '62.109.6.149';
                $ipv6 = '2a01:230:2::e2';
                break;
            case 'srv5.korden.net':
                $ipv4 = '94.250.254.141';
                $ipv6 = '';
                break;
            case 'bsd.korden.net':
                $ipv4 = '31.200.207.80';
                $ipv6 = '';
                break;
            case 'srv1.ivacuum.ru':
                $ipv4 = '82.146.36.248';
                $ipv6 = '2a01:230:2:6::16c';
                break;
            case 'srv2.ivacuum.ru':
                $ipv4 = '93.81.237.72';
                $ipv6 = '';
                break;
            default:
                $ipv4 = $ipv6 = '';
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
                'ns0' => static::NS0,
                'ns1' => static::NS1,
            ],
        ]);

        $json = json_decode($response->getBody());

        $status = $json->answer->domains[0]->result;

        if ('success' != $status) {
            \Log::error('Unable to set yandex ns servers via reg.ru api', [
                'context' => $response,
            ]);
        }

        return $status;
    }

    public function updateWhois()
    {
        if (empty($data = $this->getWhoisParsedData())) {
            return false;
        }

//        if ($this->isExpired()) {
//            unset($data['paid_till']);
//        }

        event(new Events\DomainWhoisUpdated($this, $data));

        $this->update($data);

        return true;
    }

    public function whatServerIpv4()
    {
        switch ($this->ipv4) {
            case '62.109.0.61':
                return 'srv1.korden.net';
            case '188.120.229.204':
                return 'srv2.korden.net';
            case '62.109.4.161':
                return 'srv3.korden.net';
            case '62.109.6.149':
                return 'srv4.korden.net';
            case '94.250.254.141':
                return 'srv5.korden.net';

            case '93.81.237.72':
                return 'srv2.ivacuum.ru';

            case '77.221.130.18':
                return 'srv018.infobox.ru';
            case '77.221.130.22':
                return 'srv022.infobox.ru';
            case '77.221.130.25':
                return 'srv025.infobox.ru';
            case '77.221.130.41':
                return 'srv041.infobox.ru';

            case '77.222.56.62':
                return 'vh213.sweb.ru';
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
            'base_uri' => static::REGRU_API_URL,
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
