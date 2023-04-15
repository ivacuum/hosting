<?php /** @var \App\Trip $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Опубликованные' => App\Domain\TripStatus::Published->value,
    'Пишутся' => App\Domain\TripStatus::Inactive->value,
    'Скрытые' => App\Domain\TripStatus::Hidden->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <x-th key="title"/>
    <th></th>
    <x-th-sortable key="date_start"/>
    <x-th key="slug"></x-th>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg (comment-o)</x-th-numeric-sortable>
    <th>@svg (paperclip)</th>
    <x-th-numeric-sortable key="photos_count">@svg (picture-o)</x-th-numeric-sortable>
    <th></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ Acp::show($model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Заметка скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status->isInactive())
          <span class="tooltipped tooltipped-n" aria-label="Заметка пишется">
            @svg (pencil)
          </span>
        @endif
      </td>
      <td>{{ $model->localizedDate() }}</td>
      <td>
        <a href="{{ $model->www() }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Comment, $model) }}">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </a>
      </td>
      <td>
        @if ($model->meta_image)
          <a href="{{ $model->metaImage() }}">
            <span class="tooltipped tooltipped-n" aria-label="Обложка">
              @svg (paperclip)
            </span>
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-nowrap">
        @if($model->status->isInactive() && $model->photos_count === 0)
          <a href="{{ to('acp/photos/create', ['trip_id' => $model]) }}">
            @svg(plus)
          </a>
        @else
          <a href="{{ Acp::index(new App\Photo, $model) }}">
            {{ ViewHelper::number($model->photos_count) ?: '' }}
          </a>
        @endif
      </td>
      <td>
        @if ($model->meta_image)
          <a
            class="leading-none text-xl"
            href="{{ to('acp/trips/{trip}/instagram-cover', $model->id) }}"
          >
            @svg (instagram)
          </a>
        @endif
      </td>
      <td class="md:text-right">
        @if ($model->user_id === 1)
          <a class="leading-none text-xl" href="{{ to('dev/templates/{template}', str_replace('.', '_', $model->slug)) }}">
            @svg (file-richtext)
          </a>
        @else
          <a href="{{ Acp::show(new App\User, $model->user_id) }}">#{{ $model->user_id }}</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
