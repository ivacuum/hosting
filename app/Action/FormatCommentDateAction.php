<?php namespace App\Action;

use Carbon\CarbonInterface;

class FormatCommentDateAction
{
    public function execute(CarbonInterface $date)
    {
        return $date->calendar(formats: [
            'sameDay' => __('life.date.comment_today'),
            'lastDay' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.comment_yesterday');
                }

                return __('life.date.comment_date_with_year');
            },
            'lastWeek' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.comment_date');
                }

                return __('life.date.comment_date_with_year');
            },
            'sameElse' => function (CarbonInterface $current, CarbonInterface $other) {
                if ($current->isSameYear($other)) {
                    return __('life.date.comment_date');
                }

                return __('life.date.comment_date_with_year');
            },
        ]);
    }
}
