<?php namespace App;

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
    protected $casts = [
        'clicks' => 'int',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Methods
    public function breadcrumb(): string
    {
        return $this->to;
    }

    public static function findFirstActive(): ?self
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::query()
            ->where('starts_at', '<=', now()->toDateTimeString())
            ->where('expires_at', '>=', now()->toDateTimeString())
            ->orderBy('starts_at')
            ->first();
    }

    public function www(): string
    {
        return $this->to;
    }
}
