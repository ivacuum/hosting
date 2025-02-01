<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $token
 * @property \Carbon\CarbonImmutable $created_at
 * @property User $user
 */
class LinkRequest extends Model
{
    public const string|null UPDATED_AT = null;
    public $incrementing = false;

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
