@extends('life.base')

@section('content')
<h1 class="text-3xl mb-2">
  <span class="font-medium tracking-tight">@lang('Посещенные страны')</span>
  <span class="text-base text-muted">{{ count($countries) }}</span>
</h1>
<x-trips-subnav/>

@if ($countries->count())
  <ol class="pl-8">
    @foreach ($countries as $country)
      <li class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($country->trips_published_count)
          <a class="link" href="{{ $country->www() }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
          @if ($city->trips_published_count)
            <a class="link" href="{{ $city->www() }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
