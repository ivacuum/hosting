@extends('life.base', [
  'meta_title' => trans('life.gigs_intro_title'),
])

@section('content')
<h1 class="h2 mt-0">{{ trans('life.gigs_intro_title') }}</h1>
<p>{{ trans('life.gigs_intro_text') }}</p>

@php ($year = false)
@foreach ($gigs as $gig)
  <div class="travel-entry mb-2">
    @if ($year !== $gig->date->year)
      <span class="travel-year">{{ $gig->date->year }}</span>
    @endif
    @if ($gig->status === App\Gig::STATUS_PUBLISHED)
      <a class="link" href="{{ action('Life@page', $gig->slug) }}">{{ $gig->artist->title }}</a>
    @else
      {{ $gig->artist->title }}
    @endif
    <span class="ml-1 travel-month">{{ $gig->shortDate() }}</span>
  </div>
  @php ($year = $gig->date->year)
@endforeach
@endsection
