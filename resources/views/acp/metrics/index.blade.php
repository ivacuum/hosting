@extends('acp.base')

@section('content')
<h3 class="font-medium text-2xl mb-2">@lang("$tpl.index")</h3>
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>Событие</th>
    @foreach ($dates as $date => $true)
      <th class="md:text-right whitespace-nowrap">{{ substr($date, 5) }}</th>
    @endforeach
  </tr>
  </thead>
  <tbody>
  @foreach ($events as $event)
    <tr>
      <td><a class="break-words" href="{{ path([App\Http\Controllers\Acp\Metrics::class, 'show'], $event) }}">{{ $event }}</a></td>
      @foreach ($dates as $date => $true)
        <td class="md:text-right whitespace-nowrap">{{ isset($metrics[$event][$date]) ? ViewHelper::number($metrics[$event][$date]) : '' }}</td>
      @endforeach
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
