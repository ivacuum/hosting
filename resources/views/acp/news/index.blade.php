<?php /** @var \App\News $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <x-th key="title"/>
    <th></th>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg (comment-o)</x-th-numeric-sortable>
    <x-th key="created_at"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Новость скрыта">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
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
@endsection
