@extends('acp.base', [
  'meta_title' => 'Аккаунты в Яндексе'
])

@section('content')
<div class="boxed-group flush">
  <a href="{{ action("$self@create") }}" class="boxed-group-action btn btn-success">
    <span class="glyphicon glyphicon-plus"></span>
  </a>
  <h3>Аккаунты в Яндексе</h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
      <thead>
        <tr>
          <th>#</th>
          <th>Аккаунт</th>
        </tr>
      </thead>
      @foreach ($users as $user)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $user->id) }}">
          <td>{{ $user->id }}</td>
          <td>
            <a href="{{ action("$self@show", $user->id) }}">
              {{ $user->account }}
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
@stop
