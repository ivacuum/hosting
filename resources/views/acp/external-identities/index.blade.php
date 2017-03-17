@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">ID</th>
    <th></th>
    <th>Пользователь</th>
    <th>Вход</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr>
      <td class="text-right">
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td class="bg-{{ $model->provider }}">
        <a href="{{ $model->externalLink() }}" style="color: white;">
          @svg ($model->provider)
        </a>
      </td>
      <td>
        @if ($model->user_id)
          <a class="link" href="/acp/users/{{ $model->user_id }}">{{ $model->user->email }}</a>
        @else
          {{ $model->email }}
        @endif
      </td>
      <td>{{ ViewHelper::dateShort($model->updated_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
