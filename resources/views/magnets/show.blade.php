<?php
/**
 * @var \App\Magnet $magnet
 */
?>

@extends('magnets.base')
@include('jquery')
@include('vue')
@include('livewire')

@section('magnet-download-button')
  @if (Auth::user()?->isRoot())
    <a class="btn btn-default" href="{{ Acp::show($magnet) }}">
      @lang('В админке')
    </a>
  @endif
<div class="mr-4 text-center">
  <a class="btn btn-success js-magnet" href="{{ $magnet->magnet() }}" data-action="{{ to('magnets/{magnet}/magnet', $magnet) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    @lang('Магнет')
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($magnet->size) }}
  </a>
</div>
@endsection

@section('content')
<rutracker-post>{!! $magnet->html !!}</rutracker-post>

<div class="svg-labels text-muted">
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.updated_at')">
    @svg (calendar-o)
    {{ ViewHelper::dateShort($magnet->registered_at) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.views')">
    @svg (eye)
    {{ ViewHelper::number($magnet->views) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.clicks')">
    @svg (magnet)
    {{ ViewHelper::number($magnet->clicks) }}
  </span>
  <a class="svg-flex svg-muted tooltipped tooltipped-n" href="{{ $magnet->externalLink() }}" aria-label="@lang('Первоисточник')">
    @svg (external-link)
  </a>
  <a class="btn btn-success svg-flex svg-label js-magnet" href="{{ $magnet->magnet() }}" data-action="{{ to('magnets/{magnet}/magnet', $magnet) }}">
    @svg (magnet)
    @lang('Магнет')
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($magnet->size) }}
  </a>
</div>

@if (count($tags = $magnet->titleTags()))
  <div class="mt-4">
    @foreach ($tags as $tag)
      <a
        class="border border-blueish-700 rounded mb-1 px-2 py-1 text-sm text-blueish-700 lowercase hover:bg-blueish-700 hover:text-white"
        href="{{ to('magnets', ['q' => mb_strtolower($tag)]) }}"
      >#{{ $tag }}</a>
    @endforeach
  </div>
@endif

@if (($relatedTorrents = $magnet->relatedTorrents())?->count())
  <div class="font-medium text-2xl mb-2 mt-12">
    @lang('Связанные раздачи')
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </div>
  <?php /** @var \App\Magnet $row */ ?>
  @foreach ($relatedTorrents as $row)
    <div class="flex flex-wrap md:flex-nowrap justify-center md:justify-start torrents-list-container antialiased js-torrents-views-observer" data-id="{{ $row->id }}">
      <div class="flex-shrink-0 w-8 torrent-icon order-1 md:order-none mr-1 md:text-2xl" title="{{ $row->category_id->title() }}">
        <?php $icon = $row->category_id->icon() ?>
        @svg ($icon)
      </div>
      <a class="grow mb-2 md:mb-0 md:mr-4 visited" href="{{ $row->www() }}">
        @if (Auth::user()?->torrent_short_title)
          <div>{{ $row->shortTitle() }}</div>
        @else
          <div class="font-bold">
            <x-magnet-title>{{ $row->title }}</x-magnet-title>
          </div>
        @endif
      </a>
      <a class="flex-shrink-0 pr-2 torrents-list-magnet text-center md:text-left whitespace-nowrap js-magnet"
         href="{{ $row->magnet() }}"
         title="@lang('Магнет')"
         data-action="{{ to('magnets/{magnet}/magnet', $row) }}"
      >
        @svg (magnet)
        <span class="js-magnet-counter">{{ $row->clicks ?: '' }}</span>
      </a>
      <div class="flex-shrink-0 text-center md:text-left whitespace-nowrap torrents-list-size">{{ ViewHelper::size($row->size) }}</div>
    </div>
  @endforeach
@endif

@livewire(App\Http\Livewire\Comments::class, ['model' => $magnet])
@livewire(App\Http\Livewire\CommentAddForm::class, ['model' => $magnet])
@endsection
