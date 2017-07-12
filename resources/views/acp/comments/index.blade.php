@extends('acp.list')

@section('toolbar')
<ul class="nav nav-link-tabs">
  <li class="{{ is_null($status) ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['status' => null]) }}">
      Все
    </a>
  </li>
  <li class="{{ $status === (string) App\Comment::STATUS_HIDDEN ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['status' => App\Comment::STATUS_HIDDEN]) }}">
      Скрытые
    </a>
  </li>
</ul>
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">ID</th>
    <th>Автор</th>
    <th>Текст</th>
    <th></th>
    <th>Дата</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        @if (!is_null($model->user))
          <a href="{{ path('Acp\Users@show', $model->user_id) }}">
            {{ $model->user->displayName() }}
          </a>
        @endif
      </td>
      <td>
        <div>{{ $model->html }}</div>
        <div class="text-muted small">{{ $model->rel_type }} #{{ $model->rel_id }}</div>
      </td>
      <td>
        @if ($model->status === App\Comment::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Комментарий скрыт">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td class="text-nowrap">{{ ViewHelper::dateShort($model->created_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
