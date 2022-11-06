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
    <x-th-numeric-sortable key="id"/>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'email') }}</th>
    @if ($avatar)
      <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'avatar') }}</th>
    @endif
    <th>Активен</th>
    <x-th-numeric-sortable key="comments_count">@svg(comment-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="images_count">@svg(picture-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="magnets_count">@svg(magnet)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="trips_count">@svg(plane)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="issues_count">@svg(question-circle)</x-th-numeric-sortable>
    <th>Дата реги</th>
    <x-th-sortable key="last_login_at"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ Acp::show($model) }}">
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
        <a href="{{ path([App\Http\Controllers\Acp\Magnets::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->magnets_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Trips::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Issues::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->issues_count) ?: '' }}
        </a>
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ ViewHelper::dateShort($model->last_login_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
