<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;
	
	protected $table = 'users';
	protected $hidden = ['password', 'remember_token'];

	public static function rules($id = '', $check_password = true)
	{
		// Отключение проверки на уникальность при обновлении записи
		$uid = $id ? ",{$id}" : '';
		
		return [
			'email'    => 'required|email|unique:users,email' . $uid,
			'password' => $check_password ? 'required_without:random_password|min:6' : '',
			'active'   => 'boolean',
		];
	}
	
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}
}
