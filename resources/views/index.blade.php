@extends('base')

@section('content')
@ru
  <p class="lead">Текст для главной еще не придумали. Можно <a class="link" href="{{ action('Life@index') }}">заметки</a> почитать, например.</p>
  <h3>Последние поездки</h3>
@en
  <h3 class="m-t-0">Last trips</h3>
@endlang

@foreach ($trips->chunk(3) as $chunk)
  <div class="page-section">
    @foreach ($chunk as $trip)
      <div class="page-block page-block-1x3">
        <div class="page-block-cover">
          <div class="page-block-cover-image" style="background-image: linear-gradient(rgba(26, 26, 26, 0.1) 0%, rgba(26, 26, 26, 0.3) 50%), url({{ $trip->meta_image }});"></div>
          <div class="page-block-cover-info">
            <div class="page-block-cover-title">
              {{ $trip->title }}
              <span class="page-block-cover-date">{{ $trip->period }} {{ $trip->year }}</span>
            </div>
            <div class="page-block-cover-description">{{ $trip->meta_description }}</div>
          </div>
          <a class="page-block-cover-link" href="{{ action('Life@page', $trip->slug) }}"><span></span></a>
        </div>
      </div>
    @endforeach
  </div>
@endforeach

@ru
  <p class="lead">А еще лучше слетать <a class="link pseudo js-aviasales">повидать новый город</a>.</p>
  <div id="aviasales_container"></div>
@endlang
@endsection
