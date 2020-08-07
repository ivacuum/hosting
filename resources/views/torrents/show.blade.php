<?php
/**
 * @var \App\Torrent $torrent
 */
?>

@extends('torrents.base')

@section('torrent-download-button')
<div class="mr-4 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ path([App\Http\Controllers\Torrents::class, 'magnet'], $torrent) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    {{ __('Скачать') }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>
@endsection

@section('content')
<rutracker-post>{!! $torrent->html !!}</rutracker-post>

<div class="svg-labels text-muted">
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.updated_at') }}">
    @svg (calendar-o)
    {{ ViewHelper::dateShort($torrent->registered_at) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.views') }}">
    @svg (eye)
    {{ ViewHelper::number($torrent->views) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.clicks') }}">
    @svg (magnet)
    {{ ViewHelper::number($torrent->clicks) }}
  </span>
  <a class="svg-flex svg-muted tooltipped tooltipped-n" href="{{ $torrent->externalLink() }}" aria-label="{{ __('Первоисточник') }}">
    @svg (external-link)
  </a>
  <a class="btn btn-success svg-flex svg-label js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ path([App\Http\Controllers\Torrents::class, 'magnet'], $torrent) }}">
    @svg (magnet)
    {{ __('Скачать') }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>

@if (sizeof($tags = $torrent->titleTags()))
  <div class="mt-4">
    @foreach ($tags as $tag)
      <a
        class="border border-blueish-700 rounded mb-1 px-2 py-1 text-sm text-blueish-700 lowercase hover:bg-blueish-700 hover:text-white"
        href="{{ path([App\Http\Controllers\Torrents::class, 'index'], ['q' => mb_strtolower($tag)]) }}"
      >#{{ $tag }}</a>
    @endforeach
  </div>
@endif

@if (optional($relatedTorrents = $torrent->relatedTorrents())->count())
  <div class="h3 mt-12">
    {{ __('Связанные раздачи') }}
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </div>
  <?php /** @var \App\Torrent $row */ ?>
  @foreach ($relatedTorrents as $row)
    <?php $category = TorrentCategoryHelper::find($row->category_id) ?>
    <div class="flex flex-wrap md:flex-no-wrap justify-center md:justify-start torrents-list-container antialiased js-torrents-views-observer" data-id="{{ $row->id }}">
      <div class="flex-shrink-0 w-8 torrent-icon order-1 md:order-none mr-1 md:text-2xl" title="{{ $category['title'] }}">
        <?php $icon = $category['icon'] ?? 'file-text-o' ?>
        @svg ($icon)
      </div>
      <a class="flex-grow mb-2 md:mb-0 md:mr-4 visited" href="{{ $row->www() }}">
        @if (optional(Auth::user())->torrent_short_title)
          <div>{{ $row->shortTitle() }}</div>
        @else
          <div class="font-bold">
            <x-magnet-title>{{ $row->title }}</x-magnet-title>
          </div>
        @endif
      </a>
      <a class="flex-shrink-0 pr-2 torrents-list-magnet text-center md:text-left whitespace-no-wrap js-magnet"
         href="{{ $row->magnet() }}"
         title="{{ __('Скачать') }}"
         data-action="{{ path([App\Http\Controllers\Torrents::class, 'magnet'], $row) }}"
      >
        @svg (magnet)
        <span class="js-magnet-counter">{{ $row->clicks ?: '' }}</span>
      </a>
      <div class="flex-shrink-0 text-center md:text-left whitespace-no-wrap torrents-list-size">{{ ViewHelper::size($row->size) }}</div>
    </div>
  @endforeach
@endif

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endsection
