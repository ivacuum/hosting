<?php

namespace App\Nova\Metrics;

use App\Events\Stats\TorrentMagnetClicked;
use App\Metric;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class TorrentClicksTrend extends Trend
{
    public $name = 'Torrent Clicks';
    public $width = '1/2';

    public function calculate(NovaRequest $request)
    {
        $query = (new Metric)
            ->newQuery()
            ->where('event', class_basename(TorrentMagnetClicked::class));

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
