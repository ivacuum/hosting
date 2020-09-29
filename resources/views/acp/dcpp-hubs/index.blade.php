<?php /** @var \App\DcppHub $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'address') }}</th>
    <th class="md:text-right whitespace-no-wrap">{{ ViewHelper::modelFieldTrans($modelTpl, 'clicks') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'is_online') }}</th>
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
      <td>{{ $model->externalLink() }}</td>
      <td class="md:text-right whitespace-no-wrap">{{ ViewHelper::number($model->clicks) }}</td>
      <td>
        @if ($model->is_online)
          <span class="text-green-600">
            @svg (check)
          </span>
        @else
          <span class="text-red-600">
            @svg (issue-opened)
          </span>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
