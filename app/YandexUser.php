<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $account
 * @property string $token
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|Domain[] $domains
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

    // Methods
    public function breadcrumb(): string
    {
        return $this->account;
    }
}
