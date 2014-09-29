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
		$data['registered_at'] = Carbon::parse($data['registered_at']);
		$data['paid_till'] = Carbon::parse($data['paid_till']);
		$data['queried_at'] = Carbon::now();
		$data['raw'] = $query->getRaw();
		
		return $data;
	}
	
	public function scopeWhoisReady($query)
	{
		return $query->whereActive(1)
			->where('queried_at', '<', (string) Carbon::now()->subHours(3));
	}
}
