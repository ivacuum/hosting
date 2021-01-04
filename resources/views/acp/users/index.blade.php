<?php /** @var \App\User $model */ ?>

@extends('acp.list', [
  'searchForm' => true,
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
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'email') }}</th>
    @if ($avatar)
      <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'avatar') }}</th>
    @endif
    <th>Активен</th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'images_count', 'svg' => 'picture-o'])
    </th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'torrents_count', 'svg' => 'magnet'])
    </th>
    <th class="md:text-right whitespace-nowrap">
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
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ $model->wwwAcp() }}">
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
        @if ($model->isActive())
          Да
        @endif
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Comments::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Images::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->images_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Torrents::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->torrents_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Trips::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ ViewHelper::dateShort($model->last_login_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
