<?php

namespace App\Domain\SocialMedia\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $expired_at
 * @property User $user
 *
 * @mixin \Eloquent
 */
class SocialMediaToken extends Model
{
    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->id}";
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}
