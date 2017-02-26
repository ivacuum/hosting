@extends('acp.base')

@section('content')
<h2 class="mt-0 text-break-word">{{ $event }}</h2>
<div class="flex-table flex-table-bordered">
  <div class="flex-row flex-row-header">
    <div class="flex-cell">Дата</div>
    <div class="flex-cell text-right">Кол-во</div>
  </div>
  <div class="flex-row-group flex-row-striped">
    @for ($date = $last_day; $first_day->lte($date); $date->subDay())
      @php ($day = $date->toDateString())
      <div class="flex-row">
        <div class="flex-cell">{{ $day }}</div>
        <div class="flex-cell text-right">{{ isset($metrics[$day]) ? ViewHelper::number($metrics[$day]) : '' }}</div>
      </div>
    @endfor
  </div>
</div>
@endsection
