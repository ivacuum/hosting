<?php

class Domain extends Eloquent
{
	protected $fillable = ['client_id', 'domain', 'active', 'domain_control', 'registered_at', 'paid_till', 'ipv4', 'ipv6', 'mx', 'ns', 'queried_at'];
	protected $hidden = [];
	
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
		return ['queried_at', 'registered_at', 'paid_till'];
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
		return $this->ipv4 === '144.76.40.132';
	}
	
	public function scopeWhoisReady($query)
	{
		return $query->whereActive(1)
			->where('queried_at', '<', (string) Carbon::now()->subHours(3));
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
		switch ($this->ipv4)
		{
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
