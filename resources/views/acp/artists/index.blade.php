<?php /** @var \App\Artist $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th key="title"/>
    <x-th key="slug"/>
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
      <td>{{ $model->slug }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
