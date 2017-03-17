<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Учетка внешнего сервиса
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $provider
 * @property string  $uid
 * @property string  $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ExternalIdentity extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breadcrumb()
    {
        return $this->email;
    }

    public function externalLink()
    {
        switch ($this->provider) {
            case 'facebook': return "https://www.facebook.com/{$this->uid}";
            case 'google': return "https://plus.google.com/{$this->uid}";
            case 'odnoklassniki': return "https://ok.ru/profile/{$this->uid}";
            case 'twitter': return "https://twitter.com/intent/user?user_id={$this->uid}";
            case 'vk': return "https://vk.com/id{$this->uid}";
        }

        return '#';
    }
}
