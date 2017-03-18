@extends('photos.base')

@section('content')
<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($countries as $country)
    @php ($current_initial = $country->initial())
    <div class="city-entry pb-2">
      @if ($initial !== $current_initial)
        <span class="city-initial">{{ $current_initial }}</span>
      @endif
      <a class="link" href="{{ action('Photos@country', $country->slug) }}">{{ $country->title }}</a>
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
