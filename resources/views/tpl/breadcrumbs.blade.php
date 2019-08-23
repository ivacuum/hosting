@if (!empty($breadcrumbs))
  <div class="breadcrumbs tw-text-xs tw-py-2 border-bottom tw-leading-snug">
    <nav class="tw-container" itemscope itemtype="http://schema.org/BreadcrumbList">
      <span class="{{ !Illuminate\Support\Str::startsWith($self, 'Acp\\') ? 'tw-hidden sm:tw-inline' : '' }}">
        <a href="{{ $locale_uri ?: '/' }}">
          @svg (home)
        </a>
        @svg (angle-right)
      </span>
      @foreach ($breadcrumbs as $row)
        @if (!$loop->last)
          <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="{{ $locale_uri }}/{{ $row['url'] }}" itemprop="item">
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
