@extends('acp.base')

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>
    Города
    <small>{{ sizeof($cities) }}</small>
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
      <colgroup>
        <col width="35">
        <col width="*">
        <col width="200">
        <col width="90">
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Город</th>
          <th>URL</th>
          <th>Код IATA</th>
        </tr>
      </thead>
      @foreach ($cities as $i => $city)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $city) }}">
          <td>{{ $i + 1 }}</td>
          <td>
            <span class="emoji">{{ $city->country->emoji }}</span>
            <a class="link" href="{{ action("$self@show", $city) }}">
              {{ $city->title }}
            </a>
          </td>
          <td>
            <a class="link" href="/life/{{ $city->slug }}">
              {{ $city->slug }}
            </a>
          </td>
          <td>{{ $city->iata }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
