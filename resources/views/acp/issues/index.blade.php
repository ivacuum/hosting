<?php
/** @var App\Issue $model */
?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
    <tr>
      <th><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></th>
      <th class="md:text-right whitespace-no-wrap">
        @include('acp.tpl.sortable-header', ['key' => 'id'])
      </th>
      <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
      <th></th>
      <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'author') }}</th>
      <th class="md:text-right whitespace-no-wrap">
        @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
      </th>
      <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'created_at') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($models as $model)
      <tr>
        <td><input class="models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
        <td class="md:text-right">{{ $model->id }}</td>
        <td>
          <a href="{{ path([$controller, 'show'], $model) }}">
            {{ $model->title }}
          </a>
          <div class="text-xs">
            <a href="{{ $model->page }}">
              {{ $model->page }}
            </a>
          </div>
        </td>
        <td class="text-center">
          @if ($model->isClosed())
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
        <td class="md:text-right whitespace-no-wrap">
          <a href="{{ path([App\Http\Controllers\Acp\Comments::class, 'index'], [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->comments_count) }}
          </a>
        </td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">
  @include('acp.tpl.batch', ['actions' => [
    'delete' => 'Удалить',
  ]])
</div>
@endsection
