@extends('acp.base')

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>
    Страны
    <small>{{ sizeof($countries) }}</small>
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
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
  </div>
</div>
@endsection
