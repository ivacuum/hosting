@extends('torrents.base')

@section('content')
<div class="row">
  <div class="col-md-3">
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
          <div>
            @if (!empty($category_id) && $id == $category_id)
              <mark>{{ $child['title'] }}</mark>
            @else
              <a class="link" href="{{ action("$self@index", ['category_id' => $id]) }}">{{ $child['title'] }}</a>
            @endif
            @if (!empty($stats[$id]))
              <span class="text-muted">{{ $stats[$id] }}</span>
            @endif
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
          <h4 class="m-t-2">{{ $torrent->fullDate() }}</h4>
          @php ($last_date = $torrent->registered_at)
        @endif
        @php ($category = TorrentCategoryHelper::find($torrent->category_id))
        <div class="media m-b-1">
          <div class="media-left torrent-icon">
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
              </a>
              &nbsp;{{ ViewHelper::size($torrent->size) }}
              <span class="text-muted">&nbsp;&middot;&nbsp;</span>
              <span class="text-success">{{ $torrent->seeders }} {{ trans_choice('plural.seeders', $torrent->seeders) }}</span>
              @if (empty($category_id) || $category_id != $torrent->category_id)
                <span class="text-muted">
                &nbsp;&middot;&nbsp;
                  @svg (folder-o)
                  {{ $category['title'] }}
              </span>
              @endif
            </div>
          </div>
        </div>
      @endforeach

      <div class="m-t-1 text-center">
        @include('tpl.paginator', ['paginator' => $torrents])
      </div>
    @else
      <p class="m-t-2">Подходящих раздач не найдено.</p>
    @endif
  </div>
</div>
@endsection
