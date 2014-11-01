<?php

class Client extends Eloquent
{
	protected $fillable = ['name', 'email', 'text'];
	protected $hidden = [];
	
	public static function rules($id = '')
	{
		// Отключение проверки на уникальность при обновлении записи
		$uid = $id ? ",{$id}" : '';
		
		return [
			'name'  => 'required|unique:clients,name' . $uid,
			'email' => 'email',
		];
	}

	public function domains()
	{
		return $this->hasMany('Domain');
	}

	// public static function boot()
	// {
	// 	parent::boot();
	//
	// 	static::deleted(function($client) {
	// 		// 1 — Private Person
	// 		Domain::whereClientId($client->id)
	// 			->update(['client_id' => 1]);
	// 	});
	// }
}
