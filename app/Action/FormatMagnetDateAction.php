<?php

namespace App\Action;

use Carbon\CarbonInterface;

class FormatMagnetDateAction
{
    public function execute(CarbonInterface $date)
    {
        return $date->calendar(formats: [
            'sameDay' => __('life.date.magnet_today'),
            'lastDay' => $this->formatYesterday(...),
            'lastWeek' => $this->formatDate(...),
            'sameElse' => $this->formatDate(...),
        ]);
    }

    private function formatDate(CarbonInterface $current, CarbonInterface $other): string
    {
        if ($current->isSameYear($other)) {
            return __('life.date.magnet_date');
        }

        return __('life.date.magnet_date_with_year');
    }

    private function formatYesterday(CarbonInterface $current, CarbonInterface $other): string
    {
        if ($current->isSameYear($other)) {
            return __('life.date.magnet_yesterday');
        }

        return __('life.date.magnet_date_with_year');
    }
}
