<?php

namespace App\Nova\Metrics;

use App\Events\Stats\KatakanaAnswered;
use App\Metric;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class KatakanaAnsweredTrend extends Trend
{
    public $name = 'Katakana Answered';
    public $width = '1/2';

    public function calculate(NovaRequest $request)
    {
        $query = (new Metric)
            ->newQuery()
            ->where('event', class_basename(KatakanaAnswered::class));

        return $this->sumByDays($request, $query, 'count', 'date')
            ->showLatestValue();
    }

    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
        ];
    }
}
