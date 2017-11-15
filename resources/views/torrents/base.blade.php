@extends('base')

@section('header_form')
<form class="navbar-form navbar-left" action="{{ path("$self@index") }}">
  <div class="input-group">
    <input class="form-control navbar-search-input" name="q" value="{{ old('q', @$q) }}" placeholder="{{ trans('torrents.search') }}">
    <span class="input-group-btn">
      <button class="btn btn-default">
        @svg (search)
      </button>
    </span>
  </div>
</form>
@endsection

@section('content_header')
<nav>
  <ul class="nav nav-link-tabs mb-4">
    <li class="{{ $view === 'torrents.index' ? 'active' : '' }}">
      <a href="{{ path('Torrents@index') }}">{{ trans('torrents.new') }}</a>
    </li>
    {{--
    <li class="{{ $view === 'torrents.categories' ? 'active' : '' }}">
      <a href="{{ path('Torrents@categories') }}">{{ trans('torrents.categories') }}</a>
    </li>
    --}}
    <li class="{{ $view === 'torrents.create' ? 'active' : '' }}">
      <a href="{{ path('Torrents@create') }}">{{ trans('torrents.create') }}</a>
    </li>
    <li class="{{ $view === 'torrents.faq' ? 'active' : '' }}">
      <a href="{{ path('Torrents@faq') }}">{{ trans('torrents.faq') }}</a>
    </li>
    <li class="{{ $view === 'torrents.comments' ? 'active' : '' }}">
      <a href="{{ path('Torrents@comments') }}">{{ trans('torrents.comments') }}</a>
    </li>
    @if (Auth::check())
      <li class="{{ $view === 'torrents.my' ? 'active' : '' }}">
        <a href="{{ path('Torrents@my') }}">{{ trans('torrents.my') }}</a>
      </li>
      <li>
        <a href="https://t.me/joinchat/ARFYTgllrcJ-R5S07ZLgYQ" title="{{ trans('torrents.telegram_chat') }}">
          @svg (telegram)
        </a>
      </li>
    @endif
  </ul>
</nav>
@endsection
