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
    protected $dates = ['starts_at', 'expires_at'];

    protected $casts = [
        'clicks' => 'int',
    ];

    // Methods
    public function breadcrumb(): string
    {
        return $this->to;
    }

    public static function findFirstActive(): ?self
    {
        $model = self::query()
            ->where('starts_at', '<=', now()->toDateTimeString())
            ->where('expires_at', '>=', now()->toDateTimeString())
            ->orderBy('starts_at')
            ->first();

        return value($model);
    }

    public function www(): string
    {
        return $this->to;
    }
}
