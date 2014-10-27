@extends('acp.base', [
  'meta_title' => 'Клиенты'
])

@section('content')
<div class="boxed-group flush">
  <a href="{{ route('acp.clients.create') }}" class="boxed-group-action btn btn-success">
    <span class="glyphicon glyphicon-plus"></span>
  </a>
  <h3>Клиенты</h3>
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
      @foreach ($clients as $client)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ route('acp.clients.edit', $client->id) }}">
          <td>{{ $client->id }}</td>
          <td>
            <a href="{{ route('acp.clients.show', $client->id) }}">{{ $client->name }}</a>
          </td>
          <td>{{ $client->email }}</td>
          <td>{{ nl2br(str_limit($client->text, 100)) }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
@stop
