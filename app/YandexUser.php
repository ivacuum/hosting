<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    protected $hidden = ['token'];

    // Relations
    public function domains(): HasMany
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
