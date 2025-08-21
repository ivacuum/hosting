<?php /** @var \App\Domain\Life\Models\Tag $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-sortable key="title"/>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="photos_count">@svg (picture-o)</x-th-numeric-sortable>
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
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Domain\Life\Models\Photo, $model) }}">
          {{ ViewHelper::number($model->photos_count) ?: '' }}
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
