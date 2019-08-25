@extends('base')

@section('content_header')
<div class="lg:flex flex-row-reverse items-center justify-between -mt-1 lg:-mt-2 mb-4">
  <form class="flex mb-2 lg:mb-0" action="{{ path("$self@index") }}">
    <div class="input-group">
      <input class="form-control js-search-input" name="q" value="{{ request('q') }}" placeholder="{{ trans('torrents.search') }}" autocapitalize="none">
      <div class="input-group-append">
        <button class="btn btn-default">
          @svg (search)
        </button>
      </div>
    </div>
  </form>
  @yield('torrent-download-button')
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
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
