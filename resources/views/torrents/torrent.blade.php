@extends('torrents.base')

@section('content')
<div class="panel panel-default text-center center-block torrent-stats-container">
  <div class="panel-heading">
    Статистика раздачи
    <a href="{{ $torrent->externalLink() }}">
      @svg (external-link)
    </a>
  </div>
  <div class="panel-body">
    Зарегистрирована: <strong>{{ $torrent->registered_at->diffForHumans(null, true) }}</strong>
    <span class="torrent-stats-separator">&middot;</span>
    <span class="text-success">{{ $torrent->seeders }} {{ trans_choice('plural.seeders', $torrent->seeders) }}</span>
  </div>
  <div class="panel-footer">
    <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
      {{ trans('torrents.download') }} &middot; {{ ViewHelper::size($torrent->size) }}
    </a>
  </div>
</div>
<rutracker-post>{!! $torrent->html !!}</rutracker-post>
<div class="m-y-1 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
    {{ trans('torrents.download') }} &middot; {{ ViewHelper::size($torrent->size) }}
  </a>
</div>

@include('tpl.comments-list')

@if (Auth::check())
  @include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endif

@if ($comments->total())
  <div class="m-t-1 text-center">
    @include('tpl.paginator', ['paginator' => $comments])
  </div>
@endif
@endsection
