@extends('torrents.base')

@section('content')
@foreach ($tree as $id => $category)
  <h3><a class="link" href="{{ action("$self@category", $id) }}">{{ $category['title'] }}</a></h3>
  @if (!empty($category['children']))
    @foreach ($category['children'] as $id => $child)
      <div>
        <a class="link" href="{{ action("$self@category", $id) }}">{{ $child['title'] }}</a>
        @if (!empty($stats[$id]))
          <span class="text-muted">{{ $stats[$id] }}</span>
        @endif
      </div>
    @endforeach
  @endif
@endforeach
@endsection
