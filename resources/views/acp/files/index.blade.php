<?php /** @var \App\File $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th></th>
    <x-th-numeric-sortable key="size"/>
    <x-th-numeric-sortable key="downloads"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ Acp::show($model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Файл скрыт">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td class="md:text-right text-muted whitespace-nowrap">{{ ViewHelper::size($model->size) }}</td>
      <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($model->downloads) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
