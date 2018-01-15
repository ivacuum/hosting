@extends('base')

@section('content')
@if (sizeof($users))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="text-md-right">ID</th>
      <th></th>
      <th>Псевдоним</th>
      <th>Дата регистрации</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <td class="text-md-right">{{ $user->id }}</td>
        <td class="text-center">
          <a href="{{ path("$self@show", $user) }}">
            @include('tpl.avatar', ['size' => 50])
          </a>
        </td>
        <td><a class="link" href="{{ path("$self@show", $user) }}">{{ $user->publicName() }}</a></td>
        <td>{{ ViewHelper::dateShort($user->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $users])
@endsection
