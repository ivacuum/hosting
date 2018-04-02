@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\Comment::STATUS_HIDDEN,
    'На активации' => App\Comment::STATUS_PENDING,
    'Опубликованные' => App\Comment::STATUS_PUBLISHED,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th class="text-md-right">ID</th>
    <th>Автор</th>
    <th>Текст</th>
    <th>Дата</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-md-right">
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        @if ($model->user !== null)
          <a href="{{ path('Acp\Users@show', $model->user_id) }}">
            {{ $model->user->displayName() }}
          </a>
        @endif
      </td>
      <td>
        <div class="pre-line">{{ $model->html }}</div>
        <div class="text-muted small">{{ $model->rel_type }} #{{ $model->rel_id }}</div>
      </td>
      <td class="text-nowrap">{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>
        @if ($model->status === App\Comment::STATUS_PUBLISHED)
          <a href="{{ $model->www() }}">
            @svg (external-link)
          </a>
        @elseif ($model->status === App\Comment::STATUS_HIDDEN)
          <span class="text-muted tooltipped tooltipped-n" aria-label="Комментарий скрыт">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Comment::STATUS_PENDING)
          <span class="text-muted tooltipped tooltipped-n" aria-label="Ожидает активации">
            @svg (unverified)
          </span>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
