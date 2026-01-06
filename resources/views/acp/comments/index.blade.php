<?php /** @var \App\Comment $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    __('Все') => null,
    '---' => null,
    __('Скрытые') => App\Domain\CommentStatus::Hidden->value,
    __('Ожидает активации') => App\Domain\CommentStatus::Pending->value,
    __('Опубликованные') => App\Domain\CommentStatus::Published->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"></x-th-numeric-sortable>
    <x-th key="author"></x-th>
    <x-th key="text"></x-th>
    <x-th key="created_at"></x-th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">
        <a href="{{ Acp::show($model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        @if ($model->user)
          <a href="{{ Acp::show($model->user) }}">
            {{ $model->user->displayName() }}
          </a>
        @endif
      </td>
      <td>
        <div class="whitespace-pre-line">{{ $model->html }}</div>
        <div class="text-xs text-gray-500">{{ $model->rel_type }} #{{ $model->rel_id }}</div>
      </td>
      <td class="whitespace-nowrap">{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>
        @if ($model->status->isPublished())
          <a href="{{ $model->www() }}">
            @svg (external-link)
          </a>
        @elseif ($model->status->isHidden())
          <span class="text-gray-500 tooltipped tooltipped-n" aria-label="@lang('Комментарий скрыт')">
            @svg (eye-slash)
          </span>
        @elseif ($model->status->isPending())
          <span class="text-gray-500 tooltipped tooltipped-n" aria-label="@lang('Ожидает активации')">
            @svg (unverified)
          </span>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
