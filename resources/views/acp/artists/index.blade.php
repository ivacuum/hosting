<?php /** @var \App\Domain\Life\Models\Artist $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th key="title"/>
    <x-th key="slug"/>
    <x-th-numeric-sortable key="gigs_count">@svg(music)</x-th-numeric-sortable>
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
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Domain\Life\Models\Gig, $model) }}">
          {{ ViewHelper::number($model->gigs_count) ?: '' }}
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
