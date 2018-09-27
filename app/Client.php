<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Клиент
 *
 * @property integer $id
 * @property string  $name
 * @property string  $email
 * @property string  $text
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Domain[] $domains
 *
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = ['name', 'email', 'text'];
    protected $hidden = [];
    protected $perPage = 50;

    // Relations
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    // Methods
    public function breadcrumb()
    {
        return $this->name;
    }
}
