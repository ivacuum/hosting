@extends('torrents.base')

@section('content')
<div class="row">
  <div class="col-md-3 hidden-xs">
    @foreach ($tree as $id => $category)
      <h3 class="{{ $loop->first ? 'mt-0' : '' }}">
        @if (!empty($category_id) && $id == $category_id)
          <mark>{{ $category['title'] }}</mark>
        @else
          <a class="visited" href="{{ action("$self@index", ['category_id' => $id]) }}">{{ $category['title'] }}</a>
        @endif
      </h3>
      @if (!empty($category['children']))
        @foreach ($category['children'] as $id => $child)
          @continue (empty($stats[$id]))
          <div>
            @if (!empty($category_id) && $id == $category_id)
              <mark>{{ $child['title'] }}</mark>
            @else
              <a class="visited" href="{{ action("$self@index", ['category_id' => $id]) }}">{{ $child['title'] }}</a>
            @endif
            <span class="text-muted">{{ $stats[$id] }}</span>
          </div>
        @endforeach
      @endif
    @endforeach
  </div>
  <div class="col-md-9">
    @php ($last_date = null)
    @if (sizeof($torrents))
      @foreach ($torrents as $torrent)
        @if (is_null($last_date) || !$torrent->registered_at->isSameDay($last_date))
          <h4 class="{{ $loop->first ? 'mt-0' : 'mt-4' }}">{{ $torrent->fullDate() }}</h4>
          @php ($last_date = $torrent->registered_at)
        @endif
        @php ($category = TorrentCategoryHelper::find($torrent->category_id))
        <div class="torrents-list-container">
          <div class="torrents-list-cell torrents-list-icon torrent-icon" title="{{ $category['title'] }}">
            @php ($icon = $category['icon'] ?? 'file-text-o')
            @svg ($icon)
          </div>
          <div class="torrents-list-cell torrents-list-title">
            <a class="visited" href="{{ action("{$self}@torrent", $torrent) }}">
              <torrent-title title="{{ $torrent->title }}" hide_brackets="{{ Auth::check() && Auth::user()->torrent_short_title ? 1 : '' }}"></torrent-title>
            </a>
          </div>
          <div class="torrents-list-cell torrents-list-magnet">
            <a class="link-cell js-magnet"
               href="{{ $torrent->magnet() }}"
               title="{{ trans('torrents.download') }}"
               data-action="{{ action('Torrents@magnet', $torrent) }}">
              @svg (magnet)
              @if ($torrent->clicks > 0)
                {{ $torrent->clicks }}
              @endif
            </a>
          </div>
          <div class="torrents-list-cell torrents-list-size">{{ ViewHelper::size($torrent->size) }}</div>
        </div>
      @endforeach

      @if ($torrents->hasPages())
        <div class="mt-3 text-center">
          @include('tpl.paginator', ['paginator' => $torrents])
        </div>
      @endif
    @else
      <p class="alert alert-warning">Подходящих раздач не найдено.</p>
    @endif
  </div>
</div>
@endsection
