@extends('life.base', [
  'meta_title' => trans('life.gigs_intro_title'),
])

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ trans('menu.gigs') }}" href="{{ url(path('LifeGigsRss@index')) }}">
@endpush

@section('content')
<div class="flex flex-wrap items-center mb-2">
  <h1 class="h2 mb-1 mr-4">{{ trans('life.gigs_intro_title') }}</h1>
  @if (Auth::check())
    <form class="mr-4" action="{{ path('Subscriptions@update') }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      <button class="btn btn-default btn-sm small-caps svg-flex svg-label">
        @svg (mail)
        {{ trans(Auth::user()->notify_gigs ? 'mail.unsubscribe' : 'mail.subscribe') }}
      </button>
      <input type="hidden" name="gigs" value="{{ Auth::user()->notify_gigs ? 0 : 1 }}">
      @method('put')
      @csrf
    </form>
  @else
    <a class="btn btn-default btn-sm svg-flex svg-label small-caps mr-4" href="{{ path('Subscriptions@edit', ['gigs' => 1]) }}">
      @svg (mail)
      {{ trans('mail.subscribe') }}
    </a>
  @endif
  <a class="svg-flex svg-label small-caps" href="{{ path('LifeGigsRss@index') }}">
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
    <div>
    @foreach ($rows as $gig)
      <div class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($gig->status === App\Gig::STATUS_PUBLISHED)
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
