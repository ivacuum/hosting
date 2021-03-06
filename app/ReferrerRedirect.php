<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $from
 * @property string $to
 * @property \Carbon\CarbonImmutable $starts_at
 * @property \Carbon\CarbonImmutable $expires_at
 * @property int $clicks
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class ReferrerRedirect extends Model
{
    protected $dates = ['starts_at', 'expires_at'];
    protected $guarded = ['created_at', 'updated_at', 'goto'];

    protected $casts = [
        'clicks' => 'int',
    ];

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('starts_at', '<=', now()->toDateTimeString())
            ->where('expires_at', '>=', now()->toDateTimeString());
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->to;
    }

    public static function findFirstActive()
    {
        /** @var self $model */
        $model = self::query()
            ->where('starts_at', '<=', now()->toDateTimeString())
            ->where('expires_at', '>=', now()->toDateTimeString())
            ->orderBy('starts_at')
            ->first();

        return $model;
    }

    public function www(): string
    {
        return $this->to;
    }
}
