<?php /** @var \App\Email $model */ ?>
@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <th></th>
    <x-th key="locale"/>
    <x-th key="user_id"/>
    <x-th-numeric-sortable key="views">@svg(eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="clicks">@svg(external-link)</x-th-numeric-sortable>
    <x-th key="created_at"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr>
      <td class="md:text-right">
        <a href="{{ Acp::show($model) }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        {{ $model->template }}
        <div class="text-xs text-muted">{{ $model->rel_type }} #{{ $model->rel_id }}</div>
      </td>
      <td>{{ $model->locale }}</td>
      <td><a href="{{ Acp::show($model->user) }}">{{ $model->to }}</a></td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->clicks) ?: '' }}
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
