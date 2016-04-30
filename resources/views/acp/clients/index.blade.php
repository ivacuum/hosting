@extends('acp.base')

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>
    Клиенты
    <span class="label label-default">{{ sizeof($clients) }}</span>
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
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
  </div>
</div>
@stop
