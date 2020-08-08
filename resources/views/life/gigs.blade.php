<?php
/** @var \App\Gig $gig */
?>

@extends('life.base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ __('Концерты') }}" href="{{ url(path(App\Http\Controllers\GigsRssController::class)) }}">
@endpush

@section('content')
<div class="flex flex-wrap items-center mb-2">
  <h1 class="h2 mb-1 mr-4">{{ trans('life.gigs_intro_title') }}</h1>
  @if (Auth::check())
    <form class="mr-4" action="{{ path([App\Http\Controllers\Subscriptions::class, 'update']) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      <button class="btn btn-default text-sm py-1 small-caps svg-flex svg-label">
        @svg (mail)
        {{ trans(Auth::user()->notify_gigs ? 'mail.unsubscribe' : 'mail.subscribe') }}
      </button>
      <input type="hidden" name="gigs" value="{{ Auth::user()->notify_gigs ? 0 : 1 }}">
      @method('put')
      @csrf
    </form>
  @else
    <a class="btn btn-default text-sm py-1 svg-flex svg-label small-caps mr-4" href="{{ path([App\Http\Controllers\Subscriptions::class, 'edit'], ['gigs' => 1]) }}">
      @svg (mail)
      {{ trans('mail.subscribe') }}
    </a>
  @endif
  <a class="svg-flex svg-label small-caps" href="{{ path(App\Http\Controllers\GigsRssController::class) }}">
    @svg (rss-square)
    rss
  </a>
</div>
<p>{{ trans('life.gigs_intro_text') }}</p>

@foreach ($gigs as $year => $rows)
  <div class="flex {{ !$loop->last ? 'mb-2' : '' }}">
    <div>
      <div class="sticky top-2 font-bold mr-3">{{ $year }}</div>
    </div>
    <div class="w-full">
    @foreach ($rows as $gig)
      <div class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($gig->isPublished())
          <a class="link mr-1" href="{{ $gig->www() }}">{{ $gig->artist->title }}</a>
        @else
          <span class="mr-1">{{ $gig->artist->title }}</span>
        @endif
        <span class="text-xs text-muted">{{ $gig->shortDate() }}</span>
      </div>
    @endforeach
    </div>
  </div>
@endforeach
@endsection
