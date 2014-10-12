<?php

class Client extends Eloquent
{
	protected $fillable = ['name', 'email', 'text'];
	protected $hidden = [];
	
	public static $rules = [
		'name'  => 'required',
		'email' => 'email',
	];
	
	public function domains()
	{
		return $this->hasMany('Domain');
	}
}
