@if (!empty($breadcrumbs))
  <div class="breadcrumbs text-xs py-2 border-b border-grey-200 leading-snug">
    <nav class="container flex flex-wrap items-center" {!! sizeof($breadcrumbs) > 1 ? 'itemscope itemtype="http://schema.org/BreadcrumbList"' : '' !!}>
      <span class="{{ !Str::startsWith($self, 'Acp\\') ? 'hidden sm:flex' : '' }}">
        <a href="{{ $localeUri ?: '/' }}">
          @svg (home)
        </a>
        <span class="mx-px px-px">
          @svg (angle-right)
        </span>
      </span>
      @foreach ($breadcrumbs as $row)
        @if (!$loop->last)
          <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="{{ $localeUri }}/{{ $row['url'] }}" itemprop="item">
              <span itemprop="name">{{ $row['title'] }}</span>
              <meta itemprop="position" content="{{ $loop->iteration }}">
            </a>
          </span>
        <span class="mx-px px-px">
          @svg (angle-right)
        </span>
        @else
          {{ $row['title'] }}
        @endif
      @endforeach
    </nav>
  </div>
@endif
