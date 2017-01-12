@extends('life.base', [
  'meta_title' => trans('life.intro_title'),
])

@section('content')
<div class="h2 m-t-0">{{ trans('life.intro_title') }}</div>
<p>{{ trans('life.intro_text') }}</p>

<div class="row">
  <div class="col-sm-6">
    <h3>{{ trans('life.trips') }}</h3>
    <ul class="list-inline trips-show-by">
      <li><mark>{{ trans('life.by_year') }}</mark></li>
      <li><a class="link" href="{{ action('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
      <li><a class="link" href="{{ action('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
    </ul>

    @php ($year = false)
    @foreach ($trips as $trip)
      <div class="travel-entry">
        @if ($year !== $trip->year)
          <span class="travel-year">{{ $trip->year }}</span>
        @endif
        @if ($trip->status === App\Trip::STATUS_PUBLISHED)
          <a class="link" href="{{ action('Life@page', $trip->slug) }}">{{ $trip->title }}</a>
        @else
          {{ $trip->title }}
        @endif
        <span class="travel-month">{{ $trip->period }}</span>
      </div>
      @php ($year = $trip->year)
    @endforeach
  </div>
  <div class="col-sm-6">
    <h3>{{ trans('life.favorites') }}</h3>
    @ru
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'chillout') }}">Chillout</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'books') }}">Книги</a>
      </div>
    @endlang
    <div class="favorites-entry">
      <a class="link" href="{{ action('Life@page', 'gigs') }}">
        {{ trans('menu.gigs') }}
      </a>
    </div>
    @ru
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'favorite-posts') }}">Любимые посты</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'podcasts') }}">Подкасты</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'laundry') }}">Условные обозначения стирки</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'movies') }}">Фильмы и сериалы</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="{{ action('Life@page', 'using-in-travels') }}">Чем пользуюсь в путешествиях</a>
      </div>
    @endlang
  </div>
</div>
@endsection
