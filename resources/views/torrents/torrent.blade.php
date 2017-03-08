@extends('torrents.base')

@section('content')
<div class="my-3 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    {{ trans('torrents.download') }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>
<rutracker-post>{!! $torrent->html !!}</rutracker-post>
<div class="my-3 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    {{ trans('torrents.download') }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>

<div class="text-muted">
  <span class="text-nowrap mr-3 tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.updated_at') }}">
    <span class="mr-1 svg-muted">
      @svg (calendar-o)
    </span>
    {{ ViewHelper::dateShort($torrent->registered_at) }}
  </span>
  <span class="text-nowrap mr-3 tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.views') }}">
    <span class="mr-1 svg-muted">
      @svg (eye)
    </span>
    {{ ViewHelper::number($torrent->views) }}
  </span>
  <span class="text-nowrap mr-3 tooltipped tooltipped-n" aria-label="{{ trans('model.torrent.clicks') }}">
    <span class="mr-1 svg-muted">
      @svg (magnet)
    </span>
    {{ ViewHelper::number($torrent->clicks) }}
  </span>
  <span class="text-nowrap">
    <a class="tooltipped tooltipped-n" href="{{ $torrent->externalLink() }}" aria-label="{{ trans('torrents.source') }}">
      <span class="svg-muted">
        @svg (external-link)
      </span>
    </a>
  </span>
</div>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endsection
