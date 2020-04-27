<?php
/** @var \App\Artist $model */
?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'slug') }}</th>
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
      <td>{{ $model->slug }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
