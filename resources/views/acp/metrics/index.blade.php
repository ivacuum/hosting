@extends('acp.base')

@section('content')
<h3 class="font-medium text-2xl mb-2">@lang("$tpl.index")</h3>
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th>@lang('Событие')</x-th>
    @foreach ($dates as $date => $true)
      <x-th-numeric>{{ substr($date, 5) }}</x-th-numeric>
    @endforeach
  </tr>
  </thead>
  <tbody>
  @foreach ($events as $event)
    <tr>
      <td><a class="break-words" href="{{ to('acp/metrics/{event}', $event) }}">{{ $event }}</a></td>
      @foreach ($dates as $date => $true)
        <td class="md:text-right whitespace-nowrap">{{ isset($metrics[$event][$date]) ? ViewHelper::number($metrics[$event][$date]) : '' }}</td>
      @endforeach
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
