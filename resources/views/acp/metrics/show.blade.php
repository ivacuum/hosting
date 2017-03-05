@extends('acp.base')

@section('content')
<h2 class="mt-0 text-break-word">{{ $event }}</h2>
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>Дата</th>
      <th class="text-right">Кол-во</th>
    </tr>
  </thead>
  <tbody>
    @for ($date = $last_day; $first_day->lte($date); $date->subDay())
      @php ($day = $date->toDateString())
      <tr>
        <td>{{ $day }}</td>
        <td class="text-right">{{ isset($metrics[$day]) ? ViewHelper::number($metrics[$day]) : '' }}</td>
      </tr>
    @endfor
  </tbody>
</table>
@endsection
