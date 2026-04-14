<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Domain\Metrics\Models\Metric;
use App\Domain\SortDirection;
use App\Scope\MetricWeekScope;
use Carbon\Carbon;
use Illuminate\Routing\Attributes\Controllers\Authorize;

class MetricsController
{
    #[Authorize('viewAny', Metric::class)]
    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $applyIndexGoods->execute(new Metric);

        $events = Metric::possibleMetrics();
        $metrics = $dates = [];

        Metric::query()
            ->tap(new MetricWeekScope)
            ->get()
            ->map(static function (Metric $item) use (&$metrics, &$dates) {
                $dates[$item->date->toDateString()] = true;
                $metrics[$item->event][$item->date->toDateString()] = $item->count;
            });

        return view('acp.metrics.index', [
            'dates' => $dates,
            'events' => $events,
            'metrics' => $metrics,
        ]);
    }

    #[Authorize('viewAny', Metric::class)]
    public function show(string $event)
    {
        \Breadcrumbs::push($event);

        $raw = Metric::query()
            ->where('event', $event)
            ->orderBy('date', SortDirection::Desc->value)
            ->pluck('count', 'date');

        $yearly = [];
        $daily = [];

        foreach ($raw as $date => $count) {
            $carbon = Carbon::parse($date);
            $year = $carbon->year;
            $month = $carbon->month;
            $day = $carbon->day;

            $yearly[$year] = ($yearly[$year] ?? 0) + $count;
            $daily[$year][$month][$day] = $count;
        }

        return view('acp.metrics.show', [
            'event' => $event,
            'yearly' => $yearly,
            'daily' => $daily,
        ]);
    }
}
