<?php
/** @var \App\Gig $gig */
?>

@extends('life.base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="@lang('Концерты')" href="{{ url(to('life/gigs/rss')) }}">
@endpush

@section('content')
<div class="flex flex-wrap gap-4 items-center mb-2">
  <h1 class="font-medium text-3xl tracking-tight mb-1">@lang('Посещенные и ожидаемые концерты')</h1>
  @if (Auth::check())
    <form action="@lng/subscriptions" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      <button class="btn btn-default text-sm py-1 small-caps svg-flex svg-label">
        @svg (mail)
        @lang(Auth::user()->notify_gigs->isEnabled() ? 'mail.unsubscribe' : 'mail.subscribe')
      </button>
      <input type="hidden" name="gigs" value="{{ Auth::user()->notify_gigs->isEnabled() ? App\Domain\NotificationDeliveryMethod::Disabled->value : App\Domain\NotificationDeliveryMethod::Mail->value }}">
      @method('put')
      @csrf
    </form>
  @else
    <a class="btn btn-default text-sm py-1 svg-flex svg-label small-caps" href="@lng/subscriptions?gigs=1">
      @svg (mail)
      @lang('mail.subscribe')
    </a>
  @endif
  <a class="svg-flex svg-label small-caps" href="@lng/life/gigs/rss">
    @svg (rss-square)
    rss
  </a>
</div>
@ru
  <p>Началось все с установки по концерту в год, но в 2014 что-то пошло не так...</p>
@en
  <p>It's all started with a simple plan of visiting one show per year, but something went wrong in 2014...</p>
@endru

@foreach ($gigs as $year => $rows)
  <div class="flex gap-3 {{ !$loop->last ? 'mb-2' : '' }}">
    <div>
      <div class="sticky top-2 font-bold">{{ $year }}</div>
    </div>
    <div class="w-full">
    @foreach ($rows as $gig)
      <div class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($gig->status->isPublished())
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
