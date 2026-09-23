<?php
/** @var \App\Domain\Life\Models\Gig $gig */
?>

@extends('life.base')

@push('head')
<link rel="alternate" type="application/rss+xml" title="@lang('Концерты')" href="{{ url(to('life/gigs/rss')) }}">
@endpush

@section('content')
<div class="flex flex-wrap gap-4 items-center mb-2">
  <h1 class="font-medium text-3xl tracking-tight mb-1">@lang('Посещенные и ожидаемые концерты')</h1>
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
        <span class="text-xs text-gray-500">{{ $gig->shortDate() }}</span>
      </div>
    @endforeach
    </div>
  </div>
@endforeach
@endsection
