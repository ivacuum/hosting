@extends('acp.dev.base')

@section('content')
<h2 class="font-medium text-3xl mb-2">Созданные миниатюры</h2>
@foreach ($thumbnails as $thumbnail)
  <h3 class="font-medium text-2xl mb-2">{{ basename($thumbnail['dest']) }}</h3>
  @if (false !== $thumbnail['lat'] && false !== $thumbnail['lon'])
    <p>
      @svg (location-arrow)
      {{ $thumbnail['lat'] }} {{ $thumbnail['lon'] }}
    </p>
  @endif
  <p>
    <a href="/{{ $thumbnail['dest'] }}">
      <img class="screenshot" src="/{{ $thumbnail['dest'] }}" alt="">
    </a>
  </p>
@endforeach
@endsection
