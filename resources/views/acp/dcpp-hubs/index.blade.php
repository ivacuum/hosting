<?php /** @var \App\DcppHub $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th></th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'address') }}</th>
    <th class="md:text-right whitespace-nowrap">{{ ViewHelper::modelFieldTrans($modelTpl, 'clicks') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'is_online') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td>
        <a href="{{ Acp::show($model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status->isHidden())
          <span class="text-gray-500 tooltipped tooltipped-n" aria-label="Хаб скрыт">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td>{{ $model->externalLink() }}</td>
      <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($model->clicks) }}</td>
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
