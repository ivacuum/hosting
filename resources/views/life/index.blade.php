@extends('life.base', [
  'meta_title' => trans('menu.life'),
])

@section('content')
<div class="row">
  <section class="col-sm-6 pt-0">
    <h2 class="mt-0">{{ trans('life.trips') }}</h2>
    <ul class="list-inline f14">
      <li><mark>{{ trans('life.by_year') }}</mark></li>
      <li><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
      <li><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
    </ul>

    @include('tpl.trips_by_years')
  </section>
  <section class="col-sm-6 pt-0">
    <h2 class="mt-0">{{ trans('life.favorites') }}</h2>
    <ul class="list-unstyled">
      @ru
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'chillout') }}">Chillout</a></li>
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'books') }}">Книги</a></li>
      @endlang
      <li class="mb-2"><a class="link" href="{{ path('Life@page', 'gigs') }}">{{ trans('menu.gigs') }}</a></li>
      @ru
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'favorite-posts') }}">Любимые посты</a></li>
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'podcasts') }}">Подкасты</a></li>
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'laundry') }}">Условные обозначения стирки</a></li>
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'movies') }}">Фильмы и сериалы</a></li>
        <li class="mb-2"><a class="link" href="{{ path('Life@page', 'using-in-travels') }}">Чем пользуюсь в путешествиях</a>
        </li>
      @endlang
    </ul>

    <h2 class="mt-5">{{ trans('life.languages') }}</h2>
    <ul class="list-unstyled">
      <li class="mb-2">
        <a class="link" href="{{ path('Life@page', 'english') }}">{{ trans('life.english') }}</a>
      </li>
      @ru
        <li class="mb-2">
          <a class="link" href="{{ path('Life@page', 'german') }}">{{ trans('life.german') }}</a>
        </li>
      @endlang
      <li class="mb-2">
        <a class="link" href="{{ path('Life@page', 'japanese') }}">{{ trans('life.japanese') }}</a>
      </li>
    </ul>
  </section>
</div>
@endsection
