@extends('torrents.base', [
  'websockets' => Auth::check() && empty(request()->query()),
])

@section('content')
<div class="row">
  <aside class="col-md-3 torrent-categories d-none d-md-block font-smooth">
    <nav>
      @foreach ($tree as $id => $category)
        <h3 class="{{ $loop->first ? 'mt-0' : '' }}">
          @if (!empty($category_id) && $id == $category_id)
            <mark>{{ $category['title'] }}</mark>
          @else
            <a class="visited" href="{{ path("$self@index", ['category_id' => $id]) }}">{{ $category['title'] }}</a>
          @endif
        </h3>
        @if (!empty($category['children']))
          @foreach ($category['children'] as $id => $child)
            @continue (empty($stats[$id]))
            <div>
              @if (!empty($category_id) && $id == $category_id)
                <mark>{{ $child['title'] }}</mark>
              @else
                <a class="visited" href="{{ path("$self@index", ['category_id' => $id]) }}">{{ $child['title'] }}</a>
              @endif
              <span class="text-muted f13">{{ $stats[$id] }}</span>
            </div>
          @endforeach
        @endif
      @endforeach
    </nav>
  </aside>
  <div class="col-md-9" v-cloak>
    @if (Auth::check() && empty(request()->query()))
      <chat></chat>
    @endif
    @if ($q)
      @ru
        <div class="h3 mt-0 mb-4">Результаты поиска по запросу «{{ $q }}»</div>
      @en
        <div class="h3 mt-0 mb-4">Search results for «{{ $q }}»</div>
      @endru
    @endif
    @php ($last_date = null)
    @if (sizeof($torrents))
      @foreach ($torrents as $torrent)
        @if (is_null($last_date) || !$torrent->registered_at->isSameDay($last_date))
          <h4 class="{{ $loop->first ? 'mt-0' : 'mt-4' }}">{{ $torrent->fullDate() }}</h4>
          @php ($last_date = $torrent->registered_at)
        @endif
        @php ($category = TorrentCategoryHelper::find($torrent->category_id))
        <div class="torrents-list-container font-smooth js-torrents-views-observer" data-id="{{ $torrent->id }}">
          <div class="torrents-list-cell torrents-list-icon torrent-icon" title="{{ $category['title'] }}">
            @php ($icon = $category['icon'] ?? 'file-text-o')
            @svg ($icon)
          </div>
          <div class="torrents-list-cell torrents-list-title">
            <a class="visited" href="{{ $torrent->www() }}">
              <torrent-title title="{{ $torrent->title }}" hide_brackets="{{ Auth::check() && Auth::user()->torrent_short_title ? 1 : '' }}"></torrent-title>
            </a>
          </div>
          <div class="torrents-list-cell torrents-list-magnet">
            <a class="link-cell js-magnet"
               href="{{ $torrent->magnet() }}"
               title="{{ trans('torrents.download') }}"
               data-action="{{ path('Torrents@magnet', $torrent) }}">
              @svg (magnet)
              @if ($torrent->clicks > 0)
                {{ $torrent->clicks }}
              @endif
            </a>
          </div>
          <div class="torrents-list-cell torrents-list-size">{{ ViewHelper::size($torrent->size) }}</div>
        </div>
      @endforeach

      @include('tpl.paginator', ['paginator' => $torrents, 'cloak' => true])
    @else
      <p class="alert alert-warning">Подходящих раздач не найдено.</p>
    @endif
  </div>
</div>
@endsection
