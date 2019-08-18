@extends('torrents.base')

@section('torrent-download-button')
<div class="mr-3 text-center">
  <a class="btn btn-success js-magnet" href="{{ $torrent->magnet() }}" data-action="{{ path('Torrents@magnet', $torrent) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    {{ trans('torrents.download') }}
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

@if (sizeof($tags = $torrent->titleTags()))
  <div class="mt-3">
    @foreach ($tags as $tag)
      <a
        class="btn btn-outline-primary mb-1 text-lowercase"
        href="{{ path('Torrents@index', ['q' => mb_strtolower($tag)]) }}"
      >#{{ $tag }}</a>
    @endforeach
  </div>
@endif

@if (optional($related_torrents = $torrent->relatedTorrents())->count())
  <div class="h3 mt-5">
    {{ trans('torrents.related') }}
    <small class="text-muted">{{ $related_torrents->count() }}</small>
  </div>
  @foreach ($related_torrents as $row)
    @php ($category = TorrentCategoryHelper::find($row->category_id))
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-start torrents-list-container font-smooth js-torrents-views-observer" data-id="{{ $row->id }}">
      <div class="flex-shrink-0 torrents-list-icon torrent-icon order-1 order-md-0" title="{{ $category['title'] }}">
        @php ($icon = $category['icon'] ?? 'file-text-o')
        @svg ($icon)
      </div>
      <a class="flex-grow-1 mb-2 mb-md-0 mr-md-3 visited" href="{{ $row->www() }}">
        <torrent-title title="{{ $row->title }}" hide_brackets="{{ optional(Auth::user())->torrent_short_title ? 1 : '' }}"></torrent-title>
      </a>
      <a class="flex-shrink-0 pr-2 torrents-list-magnet text-center text-md-left tw-whitespace-no-wrap js-magnet"
         href="{{ $row->magnet() }}"
         title="{{ trans('torrents.download') }}"
         data-action="{{ path('Torrents@magnet', $row) }}"
      >
        @svg (magnet)
        <span class="js-magnet-counter">{{ $row->clicks > 0 ? $row->clicks : '' }}</span>
      </a>
      <div class="flex-shrink-0 text-center text-md-left tw-whitespace-no-wrap torrents-list-size">{{ ViewHelper::size($row->size) }}</div>
    </div>
  @endforeach
@endif

@include('tpl.comments-list')
@include('tpl.comment-add', ['params' => ['torrent', $torrent->id]])
@endsection
