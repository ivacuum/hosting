@extends('acp.base')

@section('content')
<h3>
  Поездки
  <small>{{ sizeof($trips) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($trips))
  <table class="table-stats m-b-1">
    <colgroup>
      <col width="35">
      <col width="*">
      <col width="35">
      <col width="200">
      <col width="200">
    </colgroup>
    <thead>
      <tr>
        <th>#</th>
        <th>Название</th>
        <th></th>
        <th>Дата</th>
        <th>URL</th>
      </tr>
    </thead>
    @foreach ($trips as $i => $trip)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $trip) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a class="link" href="{{ action("$self@show", $trip) }}">
            {{ $trip->title }}
          </a>
        </td>
        <td>
          @if (!$trip->published)
            @php (require base_path('resources/svg/pencil.html'))
          @endif
        </td>
        <td>{{ $trip->getLocalizedDate() }}</td>
        <td>
          <a class="link" href="/life/{{ $trip->slug }}">
            {{ $trip->slug }}
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
