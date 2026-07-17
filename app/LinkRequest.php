<?php

namespace App;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $token
 * @property \Carbon\CarbonImmutable $created_at
 * @property User $user
 */
#[Table(key: 'user_id', incrementing: false)]
class LinkRequest extends Model
{
    public const string|null UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
