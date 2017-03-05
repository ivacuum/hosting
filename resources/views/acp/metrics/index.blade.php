@extends('acp.base')

@section('content')
<h2 class="mt-0">{{ trans("$tpl.index") }}</h2>
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>Событие</th>
      @foreach ($dates as $date => $true)
        <th class="text-right">{{ substr($date, 5) }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($events as $event)
      <tr>
        <td><a class="link text-break-word" href="{{ action("$self@show", $event) }}">{{ $event }}</a></td>
        @foreach ($dates as $date => $true)
          <td class="text-right">{{ isset($metrics[$event][$date]) ? ViewHelper::number($metrics[$event][$date]) : '' }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
