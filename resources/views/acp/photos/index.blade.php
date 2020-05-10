<?php /** @var \App\Photo $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'filter',
  'values' => [
    'Все' => null,
    '---' => null,
    'Без тэгов' => 'no-tags',
    'Без гео' => 'no-geo',
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <x-th key="photo"/>
    <x-th key="slug"/>
    <x-th key="tags"/>
    <x-th>@svg (map-marker)</x-th>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">
        <a class="anchor-sticky" id="{{ $model->getRouteKeyName() }}-{{ $model->getRouteKey() }}"></a>
        {{ $model->id }}
      </td>
      <td class="text-center">
        <a class="inline-block screenshot-link" href="{{ path([$controller, 'show'], $model) }}">
          <img
            class="border border-hover image-100 object-cover"
            src="{{ request('size') == 2000 ? $model->originalUrl() : (request('size') == 1000 ? $model->mobileUrl() : $model->thumbnailUrl()) }}"
            alt=""
          >
        </a>
      </td>
      <td>
        <div>{{ $model->filename() }}</div>
        <div class="text-xs text-muted">{{ $model->folder() }}</div>
      </td>
      <td>
        @foreach ($model->tags as $tag)
          <a class="block" href="{{ $tag->wwwAcp() }}">#{{ $tag->title }}</a>
        @endforeach
      </td>
      <td class="text-gray-400">
        <div>{{ $model->lat }}</div>
        <div>{{ $model->lon }}</div>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td>
        <div class="desktop-hidden">
          <a class="btn btn-default" href="{{ UrlHelper::edit($controller, $model) }}">
            @svg (pencil)
          </a>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
