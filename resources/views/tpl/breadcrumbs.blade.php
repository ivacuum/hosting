@if (!empty($breadcrumbs))
<nav class="breadcrumbs">
	<a href="/"><i class="fa fa-home"></i></a> &nbsp;&rarr;&nbsp;
  @foreach ($breadcrumbs as $i => $row)
    @if ($i != sizeof($breadcrumbs) - 1)
      <a href="/{{ $row['url'] }}">{{ $row['title'] }}</a> &nbsp;&rarr;&nbsp;
    @else
      {{ $row['title'] }}
    @endif
  @endforeach
</nav>
@endif
