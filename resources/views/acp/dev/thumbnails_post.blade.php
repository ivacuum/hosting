@extends('acp.dev.base')

@section('content')
@foreach ($thumbnails as $thumbnail)
  <h4>{{ basename($thumbnail['dest']) }}</h4>
  @if (false !== $thumbnail['lat'] && false !== $thumbnail['lon'])
    <p>
      @include('tpl.svg.location-arrow')
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
