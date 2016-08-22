@extends('acp.base')

@section('content')
<h3>
  Клиенты
  <small>{{ sizeof($clients) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($clients))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>#</th>
        <th>Клиент</th>
        <th>Почта</th>
        <th>Комментарии</th>
      </tr>
    </thead>
    @foreach ($clients as $i => $client)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $client) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a href="{{ action("$self@show", $client) }}" class="link">
            {{ $client->name }}
          </a>
        </td>
        <td>{{ $client->email }}</td>
        <td>{!! nl2br(str_limit($client->text, 100)) !!}</td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
