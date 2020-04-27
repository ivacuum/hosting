<?php
/** @var \App\Tag $model */
?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'title'])
    </th>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="md:text-right">
      @include('acp.tpl.sortable-header', ['key' => 'photos_count', 'svg' => 'picture-o'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->photos_count > 0)
          <a href="{{ path([App\Http\Controllers\Acp\Photos::class, 'index'], [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->photos_count) }}
          </a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
