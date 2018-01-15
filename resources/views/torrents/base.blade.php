@extends('base')

@section('content_header')
<div class="d-lg-flex flex-row-reverse align-items-center justify-content-between mt--1 mt-lg--3 mb-3">
  <form class="d-flex mb-2 mb-lg-0" action="{{ path("$self@index") }}">
    <div class="input-group">
      <input class="form-control" name="q" value="{{ old('q', @$q) }}" placeholder="{{ trans('torrents.search') }}" autocapitalize="none">
      <div class="input-group-append">
        <button class="btn btn-default">
          @svg (search)
        </button>
      </div>
    </div>
  </form>
  <div class="nav-link-tabs-fader nav-border">
    <div class="nav-scroll-container">
      <div class="nav-scroll">
        <nav class="nav nav-link-tabs">
          <a class="nav-link {{ $view === 'torrents.index' ? 'active' : '' }}" href="{{ path('Torrents@index') }}">
            {{ trans('torrents.new') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.create' ? 'active' : '' }}" href="{{ path('Torrents@create') }}">
            {{ trans('torrents.create') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.faq' ? 'active' : '' }}" href="{{ path('Torrents@faq') }}">
            {{ trans('torrents.faq') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.comments' ? 'active' : '' }}" href="{{ path('Torrents@comments') }}">
            {{ trans('torrents.comments') }}
          </a>
          @if (Auth::check())
            <a class="nav-link {{ $view === 'torrents.my' ? 'active' : '' }}" href="{{ path('Torrents@my') }}">
              {{ trans('torrents.my') }}
            </a>
            <a class="nav-link" href="https://t.me/joinchat/ARFYTgllrcJ-R5S07ZLgYQ" title="{{ trans('torrents.telegram_chat') }}">
              @svg (telegram)
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
