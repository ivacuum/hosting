<?php

namespace App;

use App\Domain\ExternalIdentityProvider;
use App\Policies\ExternalIdentityPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

/**
 * Учетная запись внешнего сервиса
 *
 * @property int $id
 * @property int $user_id
 * @property ExternalIdentityProvider $provider
 * @property string $uid
 * @property string $email
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
#[UsePolicy(ExternalIdentityPolicy::class)]
class ExternalIdentity extends Model
{
    protected $fillable = ['user_id'];
    protected $perPage = 50;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breadcrumb(): string
    {
        return $this->email ?: ($this->user_id ? $this->user->email : "#{$this->id}");
    }

    public function externalLink(): string
    {
        return $this->provider->externalLink($this->uid);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'provider' => ExternalIdentityProvider::class,
        ];
    }
}
