@extends('torrents.base')

@section('content')
<div class="mb-3 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ path('Torrents@magnet', $torrent) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    {{ trans('torrents.download') }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>

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
  <a class="svg-flex svg-muted tooltipped tooltipped-n" href="{{ $torrent->externalLink() }}" aria-label="{{ trans('torrents.source') }}">
    @svg (external-link)
  </a>
  <a class="btn btn-success svg-flex svg-label js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ path('Torrents@magnet', $torrent) }}">
    @svg (magnet)
    {{ trans('torrents.download') }}
    <span class="mx-2">&middot;</span>
    {{ ViewHelper::size($torrent->size) }}
  </a>
</div>

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endsection
