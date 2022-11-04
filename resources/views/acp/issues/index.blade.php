<?php /** @var App\Issue $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Открытые' => App\Domain\IssueStatus::Open->value,
    'Закрытые' => App\Domain\IssueStatus::Closed->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
    <tr>
      <th><input class="border-gray-300 js-select-all" type="checkbox" data-selector=".models-checkbox"></th>
      <x-th-numeric-sortable key="id"/>
      <x-th key="title"/>
      <th></th>
      <x-th key="author"/>
      <x-th-numeric-sortable key="comments_count">@svg (comment-o)</x-th-numeric-sortable>
      <x-th key="created_at"/>
    </tr>
  </thead>
  <tbody>
    @foreach ($models as $model)
      <tr>
        <td><input class="border-gray-300 models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
        <td class="md:text-right">{{ $model->id }}</td>
        <td>
          <a href="{{ Acp::show($model) }}">
            {{ $model->title }}
          </a>
          <div class="text-xs">
            <a href="{{ $model->page }}">
              {{ $model->page }}
            </a>
          </div>
        </td>
        <td class="text-center">
          @if ($model->status->isClosed())
            <span class="text-green-600">
              @svg (check)
            </span>
          @else
            <span class="text-red-600 tooltipped tooltipped-n" aria-label="Открыто">
              @svg (issue-opened)
            </span>
          @endif
        </td>
        <td>
          <a href="{{ path([App\Http\Controllers\Acp\Users::class, 'show'], $model->user_id) }}">
            <div>{{ $model->email }}</div>
            <div class="text-xs text-muted">{{ $model->name }}</div>
          </a>
        </td>
        <td class="md:text-right whitespace-nowrap">
          <a href="{{ path([App\Http\Controllers\Acp\Comments::class, 'index'], [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->comments_count) ?: '' }}
          </a>
        </td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">
  @include('acp.tpl.batch', [
    'actions' => [
      'delete' => 'Удалить',
    ],
    'url' => path([App\Http\Controllers\Acp\Issues::class, 'batch']),
  ])
</div>
@endsection
