@extends('acp.list', [
  'search_form' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'last_login_at',
  'values' => [
    'Неважно' => null,
    '---' => null,
    'Неделя' => 'week',
    'Месяц' => 'month',
  ]
])
@include('acp.tpl.dropdown-filter', [
  'field' => 'avatar',
  'values' => [
    'Все' => null,
    '---' => null,
    'Есть' => 1,
    'Нет' => 0,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'email') }}</th>
    @if ($avatar)
      <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'avatar') }}</th>
    @endif
    <th>Активен</th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'images_count', 'svg' => 'picture-o'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'torrents_count', 'svg' => 'magnet'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'trips_count', 'svg' => 'plane'])
    </th>
    <th>Дата реги</th>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'last_login_at'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->email }}
        </a>
        @if ($model->login)
          <div class="text-xs text-muted">{{ $model->login }}</div>
        @endif
      </td>
      @if ($avatar)
      <td>
        @include('tpl.avatar', ['user' => $model])
      </td>
      @endif
      <td>
        @if ($model->status === App\User::STATUS_ACTIVE)
          Да
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->comments_count > 0)
          <a href="{{ path('Acp\Comments@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->comments_count) }}
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->images_count > 0)
          <a href="{{ path('Acp\Images@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->images_count) }}
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->torrents_count > 0)
          <a href="{{ path('Acp\Torrents@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->torrents_count) }}
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->trips_count > 0)
          <a href="{{ path('Acp\Trips@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->trips_count) }}
          </a>
        @endif
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ ViewHelper::dateShort($model->last_login_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
