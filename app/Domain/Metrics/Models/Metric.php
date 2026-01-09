<?php

namespace App\Domain\Metrics\Models;

use App\Domain\Metrics\Policy\MetricPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\CarbonImmutable $date
 * @property string $event
 * @property int $count
 *
 * @mixin \Eloquent
 */
#[UsePolicy(MetricPolicy::class)]
class Metric extends Model
{
    public $timestamps = false;
    protected $casts = ['date' => 'datetime'];
    protected $perPage = 100;

    public static function possibleMetrics(): array
    {
        foreach (glob(app_path('Events/Stats/*.php')) as $file) {
            $events[] = pathinfo($file, PATHINFO_FILENAME);
        }

        asort($events);

        return $events ?? [];
    }
}
