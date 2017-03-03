@extends('torrents.base')

@section('content')
@if (sizeof($torrents))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell">{{ trans('model.torrent.title') }}</div>
      <div class="flex-cell text-muted text-right tooltipped tooltipped-n"
           aria-label="{{ trans('model.torrent.views') }}">@svg (eye)</div>
      <div class="flex-cell text-right tooltipped tooltipped-n"
           aria-label="{{ trans('model.torrent.comments') }}">@svg (comment-o)</div>
      <div class="flex-cell text-success text-right tooltipped tooltipped-n"
           aria-label="{{ trans('model.torrent.clicks') }}">@svg (magnet)</div>
      <div class="flex-cell">{{ trans('model.torrent.size') }}</div>
      <div class="flex-cell">{{ trans('model.torrent.updated_at') }}</div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($torrents as $torrent)
        <div class="flex-row">
          <div class="flex-cell">
            <a class="visited" href="{{ action('Torrents@torrent', $torrent) }}">
              <torrent-title title="{{ $torrent->title }}" hide_brackets="1"></torrent-title>
            </a>
          </div>
          <div class="flex-cell text-muted text-right">{{ $torrent->views ? ViewHelper::number($torrent->views) : '' }}</div>
          <div class="flex-cell text-right">{{ $torrent->comments_count ? ViewHelper::number($torrent->comments_count) : '' }}</div>
          <div class="flex-cell text-success text-right">{{ $torrent->clicks ? ViewHelper::number($torrent->clicks) : '' }}</div>
          <div class="flex-cell text-muted">{{ ViewHelper::size($torrent->size) }}</div>
          <div class="flex-cell">{{ ViewHelper::dateShort($torrent->registered_at) }}</div>
        </div>
      @endforeach
    </div>
  </div>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $torrents])
@else
  @ru
    <p>Вы еще не добавили ни одной раздачи.</p>
  @en
    <p>You haven't released anything yet.</p>
  @endlang
  <p><a class="btn btn-default" href="{{ action('Torrents@add') }}">{{ trans('torrents.add') }}</a></p>
@endif
@endsection
