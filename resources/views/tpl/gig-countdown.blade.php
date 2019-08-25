<?php
$show_time = Carbon\Carbon::parse($show_datetime);
$diff = now()->diff($show_time);
$diff_in_days = $diff->invert ? -1 * $diff->days : $diff->days;
?>

@if ($diff_in_days >= 1)
  <span class="bg-green-600 text-white p-1 text-xs font-bold rounded">через {{ ViewHelper::plural('days', $diff_in_days) }}</span>
@elseif ($diff_in_days === 0)
  <span class="bg-red-600 text-white p-1 text-xs font-bold rounded">сегодня</span>
@endif
