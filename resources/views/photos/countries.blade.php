@extends('photos.base')

@section('content')
<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($countries as $country)
    @php ($current_initial = $country->initial())
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $current_initial)
        <span class="absolute font-bold uppercase -ml-6">{{ $current_initial }}</span>
      @endif
      <a class="link" href="{{ path('Photos@country', $country->slug) }}">{{ $country->title }}</a>
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
