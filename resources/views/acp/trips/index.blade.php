<?php /** @var \App\Trip $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Опубликованные' => App\Trip::STATUS_PUBLISHED,
    'Пишутся' => App\Trip::STATUS_INACTIVE,
    'Скрытые' => App\Trip::STATUS_HIDDEN,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <x-th key="title"/>
    <th></th>
    <x-th-sortable key="date_start"/>
    <x-th key="slug"></x-th>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg (comment-o)</x-th-numeric-sortable>
    <th>@svg (paperclip)</th>
    <x-th-numeric-sortable key="photos_count">@svg (picture-o)</x-th-numeric-sortable>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Заметка скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->isInactive())
          <span class="tooltipped tooltipped-n" aria-label="Заметка пишется">
            @svg (pencil)
          </span>
        @endif
      </td>
      <td>{{ $model->localizedDate() }}</td>
      <td>
        <a href="{{ $model->www() }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->comments_count) ?: '' }}
      </td>
      <td>
        @if ($model->meta_image)
          <a href="{{ $model->metaImage() }}">
            <span class="tooltipped tooltipped-n" aria-label="Обложка">
              @svg (paperclip)
            </span>
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        <a href="{{ path([App\Http\Controllers\Acp\Photos::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->photos_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right">
        @if ($model->user_id === 1)
          <a href="{{ path([App\Http\Controllers\Acp\Dev\Templates::class, 'show'], str_replace('.', '_', $model->slug)) }}">
            @svg (file-text-o)
          </a>
        @else
          <a href="{{ path([App\Http\Controllers\Acp\Users::class, 'show'], $model->user_id) }}">#{{ $model->user_id }}</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
