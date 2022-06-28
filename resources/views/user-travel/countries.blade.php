<?php
/**
 * @var \App\User $traveler
 * @var \App\Country $country
 */
?>

@extends('user-travel.base')

@section('content')
<h1 class="h2">
  @lang('Посещенные страны')
  <span class="text-base text-muted">{{ count($countries) }}</span>
</h1>
<x-user-trips-subnav/>

@if ($countries->count())
  <ol class="pl-8">
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($country->trips_published_count)
          <a class="link" href="{{ to('@{login}/travel/countries/{country}', [$traveler->login, $country->slug]) }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
          @if ($city->trips_published_count)
            <a class="link" href="{{ to('@{login}/travel/cities/{city}', [$traveler->login, $city->slug]) }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
