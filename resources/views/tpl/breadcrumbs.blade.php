@if (!empty($breadcrumbs))
  <div class="breadcrumbs py-2 border-bottom">
    <nav class="container" itemscope itemtype="http://schema.org/BreadcrumbList">
      <span class="{{ !starts_with($self, 'Acp\\') ? 'd-none d-sm-inline' : '' }}" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
        <a href="{{ $locale_uri ?: '/' }}" itemprop="item">
          <meta itemprop="name" content="{{ trans('menu.home') }}">
          <meta itemprop="position" content="1">
          @svg (home)
        </a>
        @svg (angle-right)
      </span>
      @foreach ($breadcrumbs as $row)
        @if (!$loop->last)
          <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
            <a href="{{ $locale_uri }}/{{ $row['url'] }}" itemprop="item">
              <span itemprop="name">{{ $row['title'] }}</span>
              <meta itemprop="position" content="{{ $loop->iteration + 1 }}">
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
