@extends('acp.base')

@section('content')
<h3>
  Пользователи
  <small>{{ sizeof($users) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($users))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>#</th>
        <th>Электронная почта</th>
        <th>Активен</th>
        <th>Админ</th>
      </tr>
    </thead>
    @foreach ($users as $user)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $user) }}">
        <td>{{ $user->id }}</td>
        <td>
          <a href="{{ action("$self@show", $user) }}" class="link">
            {{ $user->email }}
          </a>
        </td>
        <td>
          @if ($user->active)
            Да
          @endif
        <td>
          @if ($user->is_admin)
            Да
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
