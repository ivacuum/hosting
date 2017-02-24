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

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endsection
