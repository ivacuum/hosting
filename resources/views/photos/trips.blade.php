@extends('photos.base')

@section('content')
@foreach ($trips->chunk(3) as $chunk)
  <div class="page-section">
    @foreach ($chunk as $trip)
      <div class="page-block page-block-1x3">
        <div class="page-block-cover">
          <div class="page-block-cover-image" style="background-image: linear-gradient(rgba(26, 26, 26, 0.1) 0%, rgba(26, 26, 26, 0.3) 50%), url({{ $trip->metaImage(400, 300) }});"></div>
          <div class="page-block-cover-info">
            <div class="page-block-cover-title">
              {{ $trip->city->country->emoji }}
              {{ $trip->title }}
              <span class="page-block-cover-date">{{ $trip->period }} {{ $trip->year }}</span>
            </div>
            <div class="page-block-cover-description">{{ $trip->meta_description }}</div>
          </div>
          <a class="page-block-cover-link" href="{{ path('Photos@trip', $trip) }}"><span></span></a>
        </div>
      </div>
    @endforeach
  </div>
@endforeach
@endsection
