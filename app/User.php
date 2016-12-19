<?php namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Пользователь
 *
 * @property integer $id
 * @property string  $email
 * @property string  $password
 * @property boolean $active
 * @property string  $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $is_admin
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    public function isRoot()
    {
        return $this->id === 1;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
