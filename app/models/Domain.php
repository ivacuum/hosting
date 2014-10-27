<?php

class Domain extends Eloquent
{
	const REGRU_API_URL = 'https://api.reg.ru/api/regru2';
	const EXPIRED_IP = '144.76.40.132';
	const NS0 = 'dns1.yandex.net';
	const NS1 = 'dns2.yandex.net';
	
	protected $fillable = ['client_id', 'domain', 'active', 'domain_control',
		'registered_at', 'paid_till', 'ipv4', 'ipv6', 'mx', 'ns', 'queried_at',
		'text', 'cms_type', 'cms_version', 'cms_url', 'cms_user', 'cms_pass',
		'ftp_host', 'ftp_user', 'ftp_pass', 'ssh_host', 'ssh_user', 'ssh_pass',
		'db_pma', 'db_host', 'db_user', 'db_pass'];
	protected $hidden = [];
	
	// public static function boot()
	// {
	// 	parent::boot();
	//
	// 	static::saving(function() {
	// 		Event::fire('domain.saving');
	// 	});
	// }
	
	public static function rules($id = '')
	{
		// Отключение проверки на уникальность при обновлении записи
		$uid = $id ? ",{$id}" : '';
		
		return [
			'domain'         => 'required|unique:domains,domain' . $uid,
			'active'         => 'boolean',
			'domain_control' => 'boolean',
		];
	}
	
	public function client()
	{
		return $this->belongsTo('Client');
	}
	
	public function getDates()
	{
		return ['mailed_at', 'queried_at', 'registered_at', 'paid_till'];
	}
	
	public function getNs()
	{
		$query = json_decode(
			file_get_contents(self::REGRU_API_URL.'/domain/get_nss'.
				'?username='.getenv('REGRU_USER').
				'&password='.getenv('REGRU_PASS').
				"&domain_name={$this->domain}"
			)
		);
		
		$ns = [];
		
		foreach ($query->answer->domains[0]->nss as $row) {
			$ns[] = $row->ns;
		}
		
		return $ns;
	}

	public function getWhoisData()
	{
		require_once __DIR__ . '/../WhoisQuery.php';
		$query = new WhoisQuery($this->domain);
		
		return $query->getRaw();
	}
	
	public function getWhoisParsedData()
	{
		require_once __DIR__ . '/../WhoisQuery.php';
	
		$query = new WhoisQuery($this->domain);
		$data = array_merge($query->parse(), $query->getDnsRecords());
		
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
		return $this->ipv4 === self::EXPIRED_IP;
	}
	
	public function scopeWhoisReady($query)
	{
		return $query->whereActive(1)
			->where('queried_at', '<', (string) Carbon::now()->subHours(3));
	}
	
	public function setYandexNs()
	{
		$query = json_decode(
			file_get_contents(self::REGRU_API_URL.'/domain/update_nss'.
				'?username='.getenv('REGRU_USER').
				'&password='.getenv('REGRU_PASS').
				"&dname={$this->domain}".
				'&ns0='.self::NS0.
				'&ns1='.self::NS1
			)
		);
		
		$status = $query->answer->domains[0]->result;
		
		if ('success' != $status) {
			Log::error('Unable to set yandex ns servers via reg.ru api', [
				'context' => $query
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
			
			Mail::queue('emails.whois.changed', compact('diff', 'data'), function($mail) use ($domain) {
				$mail->to('domains@ivacuum.ru')
					->subject($domain->domain);
			});
			
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
		
		return $this->ipv4;
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
			$diff['ns'] = ['from' => $this->ns, 'to' => $new['ns']];
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
}
