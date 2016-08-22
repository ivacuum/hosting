@extends('acp.base')

@section('content')
<h3>
  Аккаунты в Яндексе
  <small>{{ sizeof($users) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($users))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>#</th>
        <th>Аккаунт</th>
        <th>Доменов</th>
      </tr>
    </thead>
    @foreach ($users as $i => $user)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $user) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a href="{{ action("$self@show", $user) }}" class="link">
            {{ $user->account }}
          </a>
        </td>
        <td>{{ sizeof($user->domains) }}</td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
