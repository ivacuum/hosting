<?php

class YandexUser extends Eloquent
{
	protected $fillable = ['account', 'token'];
	protected $hidden = ['token'];

	public static function rules($id = '')
	{
		// Отключение проверки на уникальность при обновлении записи
		$uid = $id ? ",{$id}" : '';
		
		return [
			'account' => 'required|unique:yandex_users,account' . $uid,
			'token'   => 'required',
		];
	}
	
	public function domains()
	{
		return $this->hasMany('Domain');
	}
	
	public static function boot()
	{
		parent::boot();
		
		static::deleted(function($user) {
			Domain::whereYandexUserId($user->id)
				->update(['yandex_user_id' => 0]);
		});
	}
}
