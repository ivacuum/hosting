<?php namespace App\Nova\Metrics;

use App\Events\Stats\TorrentViewed;
use App\Metric;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class TorrentViewsMetric extends Value
{
    public $name = 'Torrent Views';

    public function calculate(NovaRequest $request)
    {
        $query = (new Metric)
            ->newQuery()
            ->where('event', class_basename(TorrentViewed::class));

        return $this->sum($request, $query, 'count', 'date');
    }

    public function ranges()
    {
        return [
            7 => '7 Days',
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'TODAY' => 'Today',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
    }
}
