@if (!empty($breadcrumbs))
<nav class="breadcrumbs">
  <a href="/">
    @php (require base_path('resources/svg/home.html'))
  </a>
  &nbsp;&rarr;&nbsp;
  @foreach ($breadcrumbs as $i => $row)
    @if ($i != sizeof($breadcrumbs) - 1)
      <a href="/{{ $locale_uri }}{{ $row['url'] }}">{{ $row['title'] }}</a> &nbsp;&rarr;&nbsp;
    @else
      {{ $row['title'] }}
    @endif
  @endforeach
</nav>
@endif
