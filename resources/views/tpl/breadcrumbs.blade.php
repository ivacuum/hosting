@if (!empty($breadcrumbs))
  <div class="breadcrumbs text-xs py-2 border-b border-gray-200 leading-snug">
    <nav class="container" {!! sizeof($breadcrumbs) > 1 ? 'itemscope itemtype="http://schema.org/BreadcrumbList"' : '' !!}>
      <span class="{{ !Str::startsWith($self, 'Acp\\') ? 'hidden sm:inline' : '' }}">
        <a href="{{ $localeUri ?: '/' }}">
          @svg (home)
        </a>
        @svg (angle-right)
      </span>
      @foreach ($breadcrumbs as $row)
        @if (!$loop->last)
          <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="{{ $localeUri }}/{{ $row['url'] }}" itemprop="item">
              <span itemprop="name">{{ $row['title'] }}</span>
              <meta itemprop="position" content="{{ $loop->iteration }}">
            </a>
          </span>
          @svg (angle-right)
        @else
          {{ $row['title'] }}
        @endif
      @endforeach
    </nav>
  </div>
@endif
