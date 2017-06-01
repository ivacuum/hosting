@if (!empty($breadcrumbs))
  <div class="breadcrumbs py-2 mb-3 border-bottom">
    <div class="container">
      <nav>
        <span class="{{ !starts_with($self, 'Acp\\') ? 'hidden-xs' : '' }}">
          <a href="{{ $locale_uri ?: '/' }}">
            @svg (home)
          </a>
          @svg (angle-right)
        </span>
        @foreach ($breadcrumbs as $row)
          @if (!$loop->last)
            <a href="{{ $locale_uri }}/{{ $row['url'] }}">{{ $row['title'] }}</a>
            @svg (angle-right)
          @else
            {{ $row['title'] }}
          @endif
        @endforeach
      </nav>
    </div>
  </div>
@else
  <div class="mb-3"></div>
@endif
