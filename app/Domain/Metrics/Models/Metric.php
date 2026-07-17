<?php

namespace App\Domain\Metrics\Models;

use App\Domain\Metrics\Policy\MetricPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\CarbonImmutable $date
 * @property string $event
 * @property int $count
 *
 * @mixin \Eloquent
 */
#[UsePolicy(MetricPolicy::class)]
#[WithoutTimestamps]
class Metric extends Model
{
    public static function possibleMetrics(): array
    {
        return once(static function () {
            $events = [];

            foreach (glob(app_path('Events/Stats/*.php')) as $file) {
                $events[] = pathinfo($file, PATHINFO_FILENAME);
            }

            asort($events);

            return $events ?? [];
        });
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
}
