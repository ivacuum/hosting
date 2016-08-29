@if (!empty($breadcrumbs))
<nav class="breadcrumbs">
  <a href="{{ $locale_uri }}/">
    @php (require base_path('resources/svg/home.html'))
  </a>
  &nbsp;&rarr;&nbsp;
  @foreach ($breadcrumbs as $row)
    @if (!$loop->last)
      <a href="{{ $locale_uri }}/{{ $row['url'] }}">{{ $row['title'] }}</a> &nbsp;&rarr;&nbsp;
    @else
      {{ $row['title'] }}
    @endif
  @endforeach
</nav>
@endif
