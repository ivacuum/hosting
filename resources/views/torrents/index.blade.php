@extends('torrents.base')

@section('content')
@if (!empty($category_id))
  <div class="m-y-1">
    <a class="btn btn-default" href="{{ action("$self@index") }}">
      Рубрика: {{ TorrentCategoryHelper::find($category_id)['title'] }}
      <span class="text-danger">
        @svg (times)
      </span>
    </a>
  </div>
@endif
@php ($last_date = null)
@if (sizeof($torrents))
  @foreach ($torrents as $torrent)
    @if (is_null($last_date) || !$torrent->registered_at->isSameDay($last_date))
      <h4 class="m-t-2">{{ $torrent->shortDate() }}</h4>
      @php ($last_date = $torrent->registered_at)
    @endif
    <div class="m-b-1 m-l-1">
      <div>
        <a class="link" href="{{ action("{$self}@torrent", $torrent) }}">
          <torrent-title title="{{ $torrent->title }}"></torrent-title>
        </a>
      </div>
      @if (empty($category_id) || $category_id != $torrent->category_id)
        <div class="torrent-breadcrumbs">
          @svg (folder-o)
          @foreach (TorrentCategoryHelper::breadcrumbs($torrent->category_id) as $id => $breadcrumb)
            {{ $breadcrumb['title'] }}
            @if (!$loop->last)
              &raquo;
            @endif
          @endforeach
          <a href="{{ action("$self@category", $torrent->category_id) }}" title="Фильтровать по рубрике">
            @svg (filter)
          </a>
        </div>
      @endif
      <div class="torrent-list-meta">
        <a class="js-magnet" href="{{ $torrent->magnet() }}" title="{{ trans('torrents.download') }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
          @svg (magnet)
        </a>
        &nbsp;{{ ViewHelper::size($torrent->size) }}
        <span class="text-muted">&nbsp;&middot;&nbsp;</span>
        <span class="text-success">{{ $torrent->seeders }} {{ trans_choice('plural.seeders', $torrent->seeders) }}</span>
      </div>
    </div>
  @endforeach

  <div class="m-t-1 text-center">
    @include('tpl.paginator', ['paginator' => $torrents])
  </div>
@else
  <p>Подходящих раздач не найдено.</p>
@endif
@endsection
