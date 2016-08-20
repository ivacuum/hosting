@extends('acp.dev.base')

@section('content')
@foreach ($thumbnails as $thumbnail)
  <h3>{{ basename($thumbnail['dest']) }}</h3>
  @if (false !== $thumbnail['lat'] && false !== $thumbnail['lon'])
    <p>
      @php (require base_path('resources/svg/location-arrow.html'))
      {{ $thumbnail['lat'] }} {{ $thumbnail['lon'] }}
    </p>
  @endif
  <p>
    <a href="/{{ $thumbnail['dest'] }}">
      <img class="screenshot" src="/{{ $thumbnail['dest'] }}">
    </a>
  </p>
@endforeach
@endsection
