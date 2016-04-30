@extends('acp.base', [
  'meta_title' => 'Поездки'
])

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>
    Поездки
    <small>{{ sizeof($trips) }}</small>
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
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
              @include('tpl.svg.pencil')
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
  </div>
</div>
@endsection
