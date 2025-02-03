<?php
/** @var string $showDatetime */
$showTime = \Carbon\CarbonImmutable::parse($showDatetime);
$diff = now()->diff($showTime);
$diffInDays = $diff->invert ? -1 * $diff->days : $diff->days;
?>

@if ($diffInDays >= 1)
  <span class="bg-green-600 text-white p-1 text-xs font-bold rounded-sm">через {{ ViewHelper::plural('days', $diffInDays) }}</span>
@elseif ($diffInDays === 0)
  <span class="bg-red-600 text-white p-1 text-xs font-bold rounded-sm">сегодня</span>
@endif
