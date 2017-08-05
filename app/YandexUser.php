<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Учетка на Яндексе
 *
 * @property integer $id
 * @property string  $account
 * @property string  $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class YandexUser extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $hidden = ['token'];

    // Relations
    public function domains()
    {
        return $this->hasMany(Domain::class)
            ->orderBy('domain');
    }

    // Events
    protected static function boot()
    {
        parent::boot();

        static::deleted(function (YandexUser $user) {
            $user->domains()->update(['yandex_user_id' => 0]);
        });
    }

    // Methods
    public function breadcrumb()
    {
        return $this->account;
    }
}
