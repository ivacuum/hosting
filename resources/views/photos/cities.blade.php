@extends('photos.base')

@section('content')
<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($cities as $city)
    @php ($current_initial = $city->initial())
    <div class="city-entry tw-relative tw-ml-6 tw-pb-2">
      @if ($initial !== $current_initial)
        <span class="tw-absolute tw-font-bold tw-uppercase tw--ml-6">{{ $current_initial }}</span>
      @endif
      <a class="link" href="{{ path('Photos@city', $city->slug) }}">{{ $city->title }}</a>
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
