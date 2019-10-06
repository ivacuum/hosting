@extends('base')

@section('content')
@if (sizeof($users))
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="md:text-right">ID</th>
      <th></th>
      <th>Псевдоним</th>
      <th>Дата регистрации</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <td class="md:text-right">{{ $user->id }}</td>
        <td class="text-center">
          <a href="{{ path([App\Http\Controllers\Users::class, 'show'], $user) }}">
            @include('tpl.avatar', ['size' => 50])
          </a>
        </td>
        <td>
          <a
            class="link"
            href="{{ path([App\Http\Controllers\Users::class, 'show'], $user) }}"
          >{{ $user->publicName() }}</a>
        </td>
        <td>{{ ViewHelper::dateShort($user->created_at) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif

@include('tpl.paginator', ['paginator' => $users])
@endsection
