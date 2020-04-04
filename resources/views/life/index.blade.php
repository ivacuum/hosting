@extends('life.base', [
  'metaTitle' => trans('menu.life'),
])

@push('head')
<link rel="alternate" type="application/rss+xml" title="{{ trans('menu.life') }}" href="{{ url(path([App\Http\Controllers\LifeTripsRss::class, 'index'])) }}">
@endpush

@section('content')
<div class="grid md:grid-cols-2 gap-8">
  <section class="pt-0">
    <div class="flex flex-wrap items-center mb-1">
      <h1 class="text-3xl mb-1 mr-4">{{ trans('life.trips') }}</h1>
      @if (Auth::check())
        <form class="mr-4" action="{{ path([App\Http\Controllers\Subscriptions::class, 'update']) }}" method="post">
          {{ ViewHelper::inputHiddenMail() }}
          <button class="btn btn-default text-sm py-1 small-caps svg-flex svg-label">
            @svg (mail)
            {{ trans(Auth::user()->notify_trips ? 'mail.unsubscribe' : 'mail.subscribe') }}
          </button>
          <input type="hidden" name="trips" value="{{ Auth::user()->notify_trips ? 0 : 1 }}">
          @method('put')
          @csrf
        </form>
      @else
        <a class="btn btn-default text-sm py-1 svg-flex svg-label small-caps mr-4" href="{{ path([App\Http\Controllers\Subscriptions::class, 'edit'], ['trips' => 1]) }}">
          @svg (mail)
          {{ trans('mail.subscribe') }}
        </a>
      @endif
      <a class="svg-flex svg-label small-caps" href="{{ path([App\Http\Controllers\LifeTripsRss::class, 'index']) }}">
        @svg (rss-square)
        rss
      </a>
    </div>
    <nav class="flex flex-wrap text-sm mb-4">
      <div class="mr-3 whitespace-no-wrap"><mark>{{ trans('life.by_year') }}</mark></div>
      <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'countries']) }}">{{ trans('life.by_country') }}</a></div>
      <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'cities']) }}">{{ trans('life.by_city') }}</a></div>
      <div class="whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'calendar']) }}">{{ trans('life.by_days') }}</a></div>
    </nav>

    @include('tpl.trips_by_years')
  </section>
  <section class="md:pt-0">
    <h2 class="text-3xl">{{ trans('life.favorites') }}</h2>
    @ru
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'chillout') }}">Chillout</a></div>
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'books') }}">Книги</a></div>
    @endru
    <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'gigs') }}">{{ trans('menu.gigs') }}</a></div>
    @ru
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'favorite-posts') }}">Любимые посты</a></div>
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'podcasts') }}">Подкасты</a></div>
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'laundry') }}">Условные обозначения стирки</a></div>
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'movies') }}">Фильмы и сериалы</a></div>
      <div class="mb-2"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'using-in-travels') }}">Чем пользуюсь в путешествиях</a></div>
    @endru

    <h2 class="text-3xl mt-12">{{ trans('life.languages') }}</h2>
    <nav>
      <div class="mb-2">
        <a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'english') }}">{{ trans('life.english') }}</a>
      </div>
      @ru
        <div class="mb-2">
          <a class="link" href="{{ path([App\Http\Controllers\Life::class, 'page'], 'german') }}">{{ trans('life.german') }}</a>
        </div>
      @endru
      <div class="mb-2">
        <a class="link" href="{{ path([App\Http\Controllers\Japanese::class, 'index']) }}">{{ trans('life.japanese') }}</a>
      </div>
    </nav>
  </section>
</div>
@endsection
