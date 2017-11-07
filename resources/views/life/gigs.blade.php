@extends('life.base', [
  'meta_title' => trans('life.gigs_intro_title'),
])

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ trans('menu.gigs') }}" href="{{ url(path('LifeGigsRss@index')) }}">
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center mb-2">
  <h1 class="h2 mt-0 mb-1 mr-3">{{ trans('life.gigs_intro_title') }}</h1>
  <a class="font-small-caps" href="{{ path('LifeGigsRss@index') }}">
    @svg (rss-square)
    rss
  </a>
</div>
<p>{{ trans('life.gigs_intro_text') }}</p>

@php ($year = false)
@foreach ($gigs as $gig)
  <div class="travel-entry mb-2">
    @if ($year !== $gig->date->year)
      <span class="travel-year">{{ $gig->date->year }}</span>
    @endif
    @if ($gig->status === App\Gig::STATUS_PUBLISHED)
      <a class="link" href="{{ $gig->www() }}">{{ $gig->artist->title }}</a>
    @else
      {{ $gig->artist->title }}
    @endif
    <span class="ml-1 travel-month">{{ $gig->shortDate() }}</span>
  </div>
  @php ($year = $gig->date->year)
@endforeach
@endsection
