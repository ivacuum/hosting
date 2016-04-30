@extends('acp.base')

@section('content')
<div class="boxed-group flush">
  @include('acp.tpl.create')
  <h3>
    Пользователи
    <span class="label label-default">{{ sizeof($users) }}</span>
  </h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
      <thead>
        <tr>
          <th>#</th>
          <th>Электронная почта</th>
          <th>Активен</th>
          <th>Админ</th>
        </tr>
      </thead>
      @foreach ($users as $i => $user)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $user) }}">
          <td>{{ $i + 1 }}</td>
          <td>
            <a href="{{ action("$self@show", $user) }}" class="link">
              {{ $user->email }}
            </a>
          </td>
          <td>
            @if ($user->active)
              Да
            @else
              <span class="text-muted">Нет</span>
            @endif
          <td>
            @if ($user->is_admin)
              Да
            @else
              <span class="text-muted">Нет</span>
            @endif
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
@stop
