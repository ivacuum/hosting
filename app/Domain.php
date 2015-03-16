<?php namespace App;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use Log;

class Domain extends Model
{
	use SoftDeletes;
	
	const REGRU_API_URL = 'https://api.reg.ru/api/regru2/';
	const EXPIRED_IP = '144.76.40.132';
	const NS0 = 'dns1.yandex.net';
	const NS1 = 'dns2.yandex.net';
	
	protected $fillable = ['client_id', 'alias_id', 'domain', 'active',
		'domain_control', 'orphan', 'registered_at', 'paid_till',
		'ipv4', 'ipv6', 'mx', 'ns', 'queried_at', 'text',
		'cms_type', 'cms_version', 'cms_url', 'cms_user', 'cms_pass',
		'ftp_host', 'ftp_user', 'ftp_pass', 'ssh_host', 'ssh_user', 'ssh_pass',
		'db_pma', 'db_host', 'db_user', 'db_pass', 'yandex_user_id'];
	protected $hidden = [];
	
	public static function boot()
	{
		parent::boot();
		
		// Домен перестает быть алиасом для других
		static::deleted(function($domain) {
			Domain::whereAliasId($domain->id)
				->update(['alias_id' => 0]);
		});
	}

	public function getRouteKey()
	{
		return $this->domain;
	}
	
	public function alias()
	{
		return $this->belongsTo('App\Domain');
	}
	
	public function client()
	{
		return $this->belongsTo('App\Client');
	}
	
	public function yandexUser()
	{
		return $this->belongsTo('App\YandexUser');
	}
	
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
		
		$json = $response->json(['object' => true]);
		
		return 'ok' !== $json->success ? $json->error : 'ok';
	}
	
	/**
	* Добавление днс-записей через API Яндекса
	*/
	public function addNsRecord($type, array $input)
	{
		if (!$this->yandex_user_id) {
			throw new \Exception('Домен не связан с учеткой в Яндексе');
		}
		
		// content, subdomain, priority, port, weight
		extract($input);

		$allowed_types = ['A', 'AAAA', 'CNAME', 'MX', 'NS', 'SRV', 'TXT'];
		$content = '@' === $content ? $this->domain : $content;
		
		if (!in_array($type, $allowed_types)) {
			throw new \Exception('Неподдерживаемый тип записи');
		}
		
		$client = $this->getYandexPddApiClient();

		$response = $client->post('admin/dns/add', [
			'query' => [
				'domain'    => $this->domain,
				'type'      => $type,
				'subdomain' => $subdomain,
				'content'   => idn_to_ascii($content),
				'priority'  => isset($priority) ? $priority : '',
				'port'      => isset($port) ? $port : '',
				'weight'    => isset($weight) ? $weight : '',
				'target'    => idn_to_ascii($content),
			],
		]);
		
		$json = $response->json(['object' => true]);
		
		return 'ok' !== $json->success ? $json->error : 'ok';
	}
	
	/**
	* Удаление днс-записей через API Яндекса
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
		
		$json = $response->json(['object' => true]);
		
		return 'ok' !== $json->success ? $json->error : 'ok';
	}
	
	/**
	* Редактирование днс-записей через API Яндекса
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
		
		// content, subdomain, priority, port, weight, retry, refresh, expire, ttl
		extract($input);
		
		$response = $client->post('admin/dns/edit', [
			'query' => [
				'domain'    => $this->domain,
				'subdomain' => $subdomain,
				'record_id' => $id,
				'content'   => idn_to_ascii($content),
				'priority'  => isset($priority) ? $priority : '',
				'port'      => isset($port) ? $port : '',
				'weight'    => isset($weight) ? $weight : '',
				'retry'     => isset($retry) ? $retry : '',
				'refresh'   => isset($refresh) ? $refresh : '',
				'expire'    => isset($expire) ? $expire : '',
				'target'    => idn_to_ascii($content),
				'ttl'       => isset($ttl) ? $ttl : '',
			],
		]);
		
		$json = $response->json(['object' => true]);

		return 'ok' !== $json->success ? $json->error : 'ok';
	}
	
	public function getDates()
	{
		return ['mailed_at', 'queried_at', 'registered_at', 'paid_till'];
	}
	
	public function getMailboxes()
	{
		if (!$this->yandex_user_id) {
			throw new \Exception('Домен не связан с учеткой в Яндексе');
		}
		
		$client = $this->getYandexPddApiClient();
		
		$response = $client->get("admin/email/list?domain={$this->domain}");
		$json = $response->json(['object' => true]);
		
		if ('ok' !== $json->success) {
			throw new \Exception("Api error: {$json->error}");
		}
		
		usort($json->accounts, function($a, $b) {
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
		
		$json = $response->json(['object' => true]);
		
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
		$json = $response->json(['object' => true]);
		
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
		
		return $response->json(['object' => true]);
	}
	
	public function getRobotsTxt()
	{
		$client = new Client();
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
		
		if (!empty($data['failed']) || empty($data['registered_at'])) {
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
		return $this->ipv4 === self::EXPIRED_IP;
	}
	
	public function scopeYandexReady($query, $user_id = 0)
	{
		return $query->whereActive(1)
			->whereIn('yandex_user_id', [0, $user_id])
			->orderBy('domain');
	}
	
	public function scopeWhoisReady($query)
	{
		return $query->whereActive(1)
			->where('queried_at', '<', (string) Carbon::now()->subHours(3));
	}
	
	public function setServerNsRecords($server)
	{
		if (!$this->yandex_user_id) {
			throw new \Exception('Домен не связан с учеткой в Яндексе');
		}
		
		$client = $this->getYandexPddApiClient();
		
		switch ($server) {
			case 'srv1.korden.net': $ipv4 = '62.109.0.61';     $ipv6 = '2a01:230:2::1fb'; break;
			case 'srv2.korden.net': $ipv4 = '188.120.229.204'; $ipv6 = '2a01:230:2::1fc'; break;
			case 'srv3.korden.net': $ipv4 = '62.109.4.161';    $ipv6 = '2a01:230:2::1fd'; break;
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
		
		$json = $response->json(['object' => true]);
		
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

		$json = $response->json(['object' => true]);
		
		$status = $json->answer->domains[0]->result;
		
		if ('success' != $status) {
			Log::error('Unable to set yandex ns servers via reg.ru api', [
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
		
		$diff = $this->checkForChanges($data);
		$this->update($data);

		if (!empty($diff)) {
			$domain = $this;
			
			register_shutdown_function(
				['Mail', 'send'],
				'emails.whois.changed',
				compact('diff', 'data'),
				function($mail) use ($domain) {
					$mail->to('domains@ivacuum.ru')
						->subject($domain->domain);
				}
			);
			
			return $diff;
		}
		
		return true;
	}
	
	public function whatServerIpv4()
	{
		switch ($this->ipv4) {
			case '62.109.0.61': return 'srv1.korden.net';
			case '188.120.229.204': return 'srv2.korden.net';
			case '62.109.4.161': return 'srv3.korden.net';
			
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

	/**
	* Проверка изменения данных домена (ip, mx, ns, etc.)
	*/
	protected function checkForChanges(array $new)
	{
		$diff = [];
		
		if ($new['ipv4'] != $this->ipv4) {
			$diff['ipv4'] = ['from' => $this->ipv4, 'to' => $new['ipv4']];
		}
		
		if ($new['ipv6'] != $this->ipv6) {
			$diff['ipv6'] = ['from' => $this->ipv6, 'to' => $new['ipv6']];
		}
		
		if ($new['mx'] != $this->mx) {
			$diff['mx'] = ['from' => $this->mx, 'to' => $new['mx']];
		}
		
		if (isset($new['ns']) && $new['ns'] != $this->ns) {
			// Workaround dns1.yandex.ru to dns1.yandex.net and vice versa
			if (false === strpos($new['ns'], 'dns1.yandex.') ||
				false === strpos($this->ns, 'dns1.yandex.')
			) {
				$diff['ns'] = ['from' => $this->ns, 'to' => $new['ns']];
			}
		}
		
		if ($new['registered_at']->diffInDays($this->registered_at) > 300) {
			$diff['registered_at'] = [
				'from' => (string) $this->registered_at,
				'to'   => (string) $new['registered_at']
			];
		}
		
		if ($new['paid_till']->diffInHours($this->paid_till) > 24) {
			$diff['paid_till'] = [
				'from' => (string) $this->paid_till,
				'to'   => (string) $new['paid_till'],
			];
		}

		return $diff;
	}
	
	protected function getRegRuApiClient()
	{
		return new Client([
			'base_url' => self::REGRU_API_URL,
			'defaults' => [
				'query' => [
					'username' => env('REGRU_USER'),
					'password' => env('REGRU_PASS'),
				],
			],
		]);
	}
	
	protected function getYandexPddApiClient()
	{
		static $client;
		
		if (empty($client)) {
			$client = new Client([
				'base_url' => 'https://pddimp.yandex.ru/api2/',
				'defaults' => [
					'headers' => ['PddToken' => $this->yandexUser->token],
				],
			]);
		}
		
		return $client;
	}
}
