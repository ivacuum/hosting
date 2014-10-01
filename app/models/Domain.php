<?php

class Domain extends Eloquent
{
	protected $fillable = ['domain', 'active', 'domain_control', 'registered_at', 'paid_till', 'ipv4', 'ipv6', 'mx', 'ns', 'queried_at'];
	protected $hidden = [];
	
	public static $rules = [
		'domain'         => 'required|unique:domains',
		'active'         => 'boolean',
		'domain_control' => 'boolean',
	];
	
	public function getDates()
	{
		return ['updated_at', 'queried_at', 'registered_at', 'paid_till'];
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
			return false;
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
}
