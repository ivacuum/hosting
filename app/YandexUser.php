<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class YandexUser extends Model
{
    protected $fillable = ['account', 'token'];
    protected $hidden = ['token'];

    public function domains()
    {
        return $this->hasMany(Domain::class)
            ->orderBy('domain');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {
            Domain::where('yandex_user_id', $user->id)
                ->update(['yandex_user_id' => 0]);
        });
    }

    public function breadcrumb()
    {
        return $this->account;
    }
}
