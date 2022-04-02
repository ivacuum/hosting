<?php namespace App\Action;

use Carbon\CarbonInterface;

class FormatTripPeriodAction
{
    public function execute(CarbonInterface $start, CarbonInterface $end)
    {
        if ($end->isSameDay($start)) {
            return $start->isoFormat(__('life.date.day_month'));
        }

        if (!$end->isSameMonth($start)) {
            return sprintf(
                __('life.date.day_month_day_month'),
                $start->day,
                $start->isoFormat('MMMM', 'D MMMM'),
                $end->day,
                $end->isoFormat('MMMM', 'D MMMM')
            );
        }

        return sprintf(
            __('life.date.day_day_month'),
            $start->day,
            $end->day,
            $start->isoFormat('MMMM', 'D MMMM')
        );
    }
}
