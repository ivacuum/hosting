@extends('acp.base')

@section('content')
<h3>
  Страны
  <small>{{ sizeof($countries) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($countries))
  <table class="table-stats m-b-1">
    <colgroup>
      <col width="35">
      <col width="*">
      <col width="200">
    </colgroup>
    <thead>
      <tr>
        <th>#</th>
        <th>Город</th>
        <th>URL</th>
      </tr>
    </thead>
    @foreach ($countries as $i => $country)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $country) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <span class="emoji">{{ $country->emoji }}</span>
          <a class="link" href="{{ action("$self@show", $country) }}">
            {{ $country->title }}
          </a>
        </td>
        <td>
          <a class="link" href="/life/countries/{{ $country->slug }}">
            {{ $country->slug }}
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
