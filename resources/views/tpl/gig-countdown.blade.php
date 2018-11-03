<?php
$show_time = Carbon\Carbon::parse($show_datetime);
$diff = now()->diff($show_time);
$diff_in_days = $diff->invert ? -1 * $diff->days : $diff->days;
?>

@if ($diff_in_days >= 1)
  <span class="badge badge-success">через {{ ViewHelper::plural('days', $diff_in_days) }}</span>
@elseif ($diff_in_days === 0)
  <span class="badge badge-danger">сегодня</span>
@endif
