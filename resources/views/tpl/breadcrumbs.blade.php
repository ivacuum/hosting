@if (!empty($breadcrumbs))
<nav class="breadcrumbs">
  <a href="{{ $locale_uri }}/">
    @svg (home)
  </a>
  @svg (angle-right)
  @foreach ($breadcrumbs as $row)
    @if (!$loop->last)
      <a href="{{ $locale_uri }}/{{ $row['url'] }}">{{ $row['title'] }}</a>
      @svg (angle-right)
    @else
      {{ $row['title'] }}
    @endif
  @endforeach
</nav>
@endif
