<?php namespace App\Action;

use Carbon\CarbonInterface;

class FormatMagnetDateAction
{
    public function execute(CarbonInterface $date)
    {
        return $date->calendar(formats: [
            'sameDay' => __('life.date.magnet_today'),
            'lastDay' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.magnet_yesterday');
                }

                return __('life.date.magnet_date_with_year');
            },
            'lastWeek' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.magnet_date');
                }

                return __('life.date.magnet_date_with_year');
            },
            'sameElse' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.magnet_date');
                }

                return __('life.date.magnet_date_with_year');
            },
        ]);
    }
}
