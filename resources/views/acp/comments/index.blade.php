@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Текст</th>
        <th>Дата</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>
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
          <div class="text-muted">
            <small>
              {{ $model->rel_type }} #{{ $model->rel_id }}
            </small>
          </div>
        </td>
        <td nowrap>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
  </table>

  <div class="mt-3 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
