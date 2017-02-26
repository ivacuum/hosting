@extends('acp.base')

@section('content')
<h2 class="mt-0">{{ trans("$tpl.index") }}</h2>
<div class="flex-table flex-table-bordered">
  <div class="flex-row flex-row-header">
    <div class="flex-cell">Событие</div>
    @foreach ($dates as $date => $true)
      <div class="flex-cell text-right">{{ substr($date, 5) }}</div>
    @endforeach
  </div>
  <div class="flex-row-group flex-row-striped">
    @foreach ($events as $event)
      <div class="flex-row">
        <div class="flex-cell">
          <a class="link text-break-word" href="{{ action("$self@show", $event) }}">{{ $event }}</a>
        </div>
        @foreach ($dates as $date => $true)
          <div class="flex-cell text-right">{{ isset($metrics[$event][$date]) ? ViewHelper::number($metrics[$event][$date]) : '' }}</div>
        @endforeach
      </div>
    @endforeach
  </div>
</div>
@endsection
