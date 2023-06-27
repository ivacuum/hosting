<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Metric;
use App\Scope\MetricWeekScope;
use Carbon\Carbon;

class MetricsController
{
    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $applyIndexGoods->execute(new Metric);

        $events = Metric::possibleMetrics();
        $metrics = $dates = [];

        Metric::tap(new MetricWeekScope)
            ->get()
            ->map(function (Metric $item) use (&$metrics, &$dates) {
                $dates[$item->date->toDateString()] = true;
                $metrics[$item->event][$item->date->toDateString()] = $item->count;
            });

        return view('acp.metrics.index', [
            'dates' => $dates,
            'events' => $events,
            'metrics' => $metrics,
        ]);
    }

    public function show(string $event)
    {
        \Breadcrumbs::push($event);

        $metrics = Metric::where('event', $event)->pluck('count', 'date');
        $lastDay = Carbon::parse(array_key_last($metrics->toArray()));
        $firstDay = Carbon::parse(array_key_first($metrics->toArray()));

        return view('acp.metrics.show', [
            'event' => $event,
            'lastDay' => $lastDay,
            'metrics' => $metrics,
            'firstDay' => $firstDay,
        ]);
    }
}
