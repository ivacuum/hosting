@extends('torrents.base')

@section('content')
<div class="row">
  <div class="col-md-3 hidden-xs">
    @foreach ($tree as $id => $category)
      <h3>
        @if (!empty($category_id) && $id == $category_id)
          <mark>{{ $category['title'] }}</mark>
        @else
          <a class="link" href="{{ action("$self@index", ['category_id' => $id]) }}">{{ $category['title'] }}</a>
        @endif
      </h3>
      @if (!empty($category['children']))
        @foreach ($category['children'] as $id => $child)
          @continue (empty($stats[$id]))
          <div>
            @if (!empty($category_id) && $id == $category_id)
              <mark>{{ $child['title'] }}</mark>
            @else
              <a class="link" href="{{ action("$self@index", ['category_id' => $id]) }}">{{ $child['title'] }}</a>
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
          <h4 class="mt-4">{{ $torrent->fullDate() }}</h4>
          @php ($last_date = $torrent->registered_at)
        @endif
        @php ($category = TorrentCategoryHelper::find($torrent->category_id))
        <div class="media mb-3">
          <div class="media-left torrent-icon" title="{{ $category['title'] }}">
            @php ($icon = $category['icon'] ?? 'file-text-o')
            @svg ($icon)
          </div>
          <div class="media-body">
            <div>
              <a class="link" href="{{ action("{$self}@torrent", $torrent) }}">
                <torrent-title title="{{ $torrent->title }}"></torrent-title>
              </a>
            </div>
            <div class="torrent-list-meta">
              <a class="js-magnet" href="{{ $torrent->magnet() }}" title="{{ trans('torrents.download') }}" data-action="{{ action('Torrents@magnet', $torrent) }}">
                @svg (magnet)
                @if ($torrent->clicks > 0)
                  {{ $torrent->clicks }}
                @endif
              </a>
              <span class="mx-1 text-muted">&middot;</span>
              {{ ViewHelper::size($torrent->size) }}
              @if (empty($category_id) || $category_id != $torrent->category_id)
                <span class="mx-1 text-muted">&middot;</span>
                <span class="text-muted">
                  @svg (folder-o)
                  {{ $category['title'] }}
                </span>
              @endif
            </div>
          </div>
        </div>
      @endforeach

      <div class="mt-3 text-center">
        @include('tpl.paginator', ['paginator' => $torrents])
      </div>
    @else
      <p class="mt-4">Подходящих раздач не найдено.</p>
    @endif
  </div>
</div>
@endsection
