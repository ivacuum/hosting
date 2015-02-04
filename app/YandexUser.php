<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YandexUser extends Model
{
	use SoftDeletes;
	
	protected $fillable = ['account', 'token'];
	protected $hidden = ['token'];

	public function domains()
	{
		return $this->hasMany('App\Domain')
			->orderBy('domain');
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
