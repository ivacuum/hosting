<?php
$show_time = Carbon\Carbon::parse($show_datetime);
$diff = now()->diff($show_time);
$diff_in_days = $diff->invert ? -1 * $diff->days : $diff->days;
?>

@if ($diff_in_days >= 1)
  <span class="tw-bg-green-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded">через {{ ViewHelper::plural('days', $diff_in_days) }}</span>
@elseif ($diff_in_days === 0)
  <span class="tw-bg-red-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded">сегодня</span>
@endif
