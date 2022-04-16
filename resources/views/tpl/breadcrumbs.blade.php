@if (!empty($breadcrumbs))
  <div class="bg-[#fafafa] dark:bg-slate-800 text-xs py-2 border-b border-grey-200 dark:border-slate-700 leading-snug">
    <nav class="container flex flex-wrap items-center" {!! sizeof($breadcrumbs) > 1 ? 'itemscope itemtype="https://schema.org/BreadcrumbList"' : '' !!}>
      <span class="hidden sm:flex">
        <a href="{{ to('/') }}">
          @svg (home)
        </a>
        <span class="mx-px px-px text-gray-500">
          @svg (angle-right)
        </span>
      </span>
      @foreach ($breadcrumbs as $row)
        @if (!$loop->last)
          <span itemscope itemtype="https://schema.org/ListItem" itemprop="itemListElement">
            <a href="@lng/{{ $row['url'] }}" itemprop="item">
              <span itemprop="name">{{ $row['title'] }}</span>
              <meta itemprop="position" content="{{ $loop->iteration }}">
            </a>
          </span>
        <span class="mx-px px-px text-gray-500">
          @svg (angle-right)
        </span>
        @else
          <span>{{ $row['title'] }}</span>
        @endif
      @endforeach
    </nav>
  </div>
@endif
