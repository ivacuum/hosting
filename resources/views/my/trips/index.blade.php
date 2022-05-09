<?php /** @var \App\Trip $model */ ?>

@extends('my.base')

@section('content')
<div class="flex flex-wrap items-center">
  <h3 class="my-1 mr-3">
    @lang('Поездки')
    <span class="text-base text-muted whitespace-nowrap">{{ ViewHelper::number($models->total()) }}</span>
  </h3>
  <a class="btn btn-success my-1 mr-1" href="{{ path([App\Http\Controllers\MyTrips::class, 'create']) }}">
    @lang('acp.trips.create')
  </a>
  @if (Auth::user()?->login)
    <a
      class="btn btn-default my-1 mr-1"
      href="{{ path([App\Http\Controllers\UserTravelTrips::class, 'index'], Auth::user()->login) }}"
    >
      Просмотреть
    </a>
  @endif
  <a class="btn btn-default my-1" href="@lng/docs/trips">
    @svg (question-circle)
  </a>
</div>

@if ($models->count())
  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="md:text-right">#</th>
      <th class="md:text-left">{{ ViewHelper::modelFieldTrans('trip', 'title') }}</th>
      <th></th>
      <th class="md:text-left">Дата начала</th>
      <th class="md:text-left">{{ ViewHelper::modelFieldTrans('trip', 'slug') }}</th>
      <th class="md:text-right whitespace-nowrap">@svg (eye)</th>
      <th class="md:text-right whitespace-nowrap">@svg (comment-o)</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit(App\Http\Controllers\MyTrips::class, $model) }}">
        <td class="md:text-right"><span class="sm:hidden">#</span>{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
        <td>{{ $model->title }}</td>
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
          @if ($model->status->isPublished())
            <a href="{{ $model->www() }}">{{ $model->slug }}</a>
          @else
            {{ $model->slug }}
          @endif
        </td>
        <td class="md:text-right whitespace-nowrap">
          {{ ViewHelper::number($model->views) ?: '' }}
        </td>
        <td class="md:text-right whitespace-nowrap">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </td>
        <td><a href="{{ UrlHelper::edit(App\Http\Controllers\MyTrips::class, $model) }}">@svg (pencil)</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['paginator' => $models])
@else
  <p>Хронология ваших поездок на данный момент пуста.</p>
  <p>Самое время <a href="{{ path([App\Http\Controllers\MyTrips::class, 'create']) }}">добавить первую</a>.</p>
@endif
@endsection
