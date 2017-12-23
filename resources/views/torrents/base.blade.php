@extends('base')

@section('content_header')
<div class="d-md-flex flex-row-reverse justify-content-between mt--3">
  <form class="d-flex align-items-start mb-2 mb-md-0 mt-3 mt-md-1" action="{{ path("$self@index") }}">
    <input class="form-control w-1020 w2-md-auto input-has-right-addon" name="q" value="{{ old('q', @$q) }}" placeholder="{{ trans('torrents.search') }}">
    <button class="btn btn-default btn-right-addon">
      @svg (search)
    </button>
  </form>
  <nav class="nav-link-tabs-fader">
    <ul class="nav nav-link-tabs nav-link-tabs-border mb-4">
      <li class="{{ $view === 'torrents.index' ? 'active' : '' }}">
        <a href="{{ path('Torrents@index') }}">{{ trans('torrents.new') }}</a>
      </li>
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
</div>
@endsection
