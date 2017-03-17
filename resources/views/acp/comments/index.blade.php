@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">ID</th>
    <th>Автор</th>
    <th>Текст</th>
    <th>Дата</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
      <td class="text-right">
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        @if (!is_null($model->user))
          <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
            {{ $model->user->displayName() }}
          </a>
        @endif
      </td>
      <td>
        <div>{{ $model->html }}</div>
        <div class="text-muted small">{{ $model->rel_type }} #{{ $model->rel_id }}</div>
      </td>
      <td class="text-nowrap">{{ ViewHelper::dateShort($model->created_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
