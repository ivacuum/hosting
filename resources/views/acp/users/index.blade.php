<?php /** @var \App\User $model */ ?>

@extends('acp.list', [
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'last_login_at',
  'values' => [
    __('Неважно') => null,
    '---' => null,
    __('Неделя') => 'P1W',
    __('Месяц') => 'P1M',
  ]
])
@include('acp.tpl.dropdown-filter', [
  'field' => 'avatar',
  'values' => [
    __('Все') => null,
    '---' => null,
    __('Есть') => 1,
    __('Нет') => 0,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <x-th key="email"></x-th>
    @if($avatar)
      <x-th key="avatar"></x-th>
    @endif
    <th>@lang('Активен')</th>
    <x-th-numeric-sortable key="chat_messages_count">@svg(paper-airplane-16)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg(comment-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="images_count">@svg(picture-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="magnets_count">@svg(magnet)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="trips_count">@svg(plane)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="issues_count">@svg(question-circle)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="emails_count">@svg(envelope-o)</x-th-numeric-sortable>
    <x-th key="created_at"></x-th>
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
          <div class="text-xs text-gray-500">{{ $model->login }}</div>
        @endif
      </td>
      @if ($avatar)
      <td>
        @include('tpl.avatar', ['user' => $model])
      </td>
      @endif
      <td>
        @if ($model->isActive())
          @lang('Да')
        @endif
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\ChatMessage, $model) }}">
          {{ ViewHelper::number($model->chat_messages_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Comment, $model) }}">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Image, $model) }}">
          {{ ViewHelper::number($model->images_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Domain\Magnet\Models\Magnet, $model) }}">
          {{ ViewHelper::number($model->magnets_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Domain\Life\Models\Trip, $model) }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Issue, $model) }}">
          {{ ViewHelper::number($model->issues_count) ?: '' }}
        </a>
      </td>
      <td>{{ ViewHelper::number($model->emails_count) ?: '' }}</td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ ViewHelper::dateShort($model->last_login_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
