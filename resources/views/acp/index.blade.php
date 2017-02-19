@extends('acp.base')

@section('content')
<h2 class="mt-0">Метрики</h2>
<div class="flex-table flex-table-bordered">
  <div class="flex-row flex-row-header">
    <div class="flex-cell">Событие</div>
    <div class="flex-cell text-right">Кол-во</div>
  </div>
  <div class="flex-row-group flex-row-striped">
    @foreach ($events as $event)
      <div class="flex-row">
        <div class="flex-cell">{{ $event }}</div>
        <div class="flex-cell text-right">{{ isset($metrics[$event]) ? ViewHelper::number($metrics[$event]) : '' }}</div>
      </div>
    @endforeach
  </div>
</div>
@endsection
