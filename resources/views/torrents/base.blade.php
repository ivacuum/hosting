@extends('base')

@section('header_form')
<form class="navbar-form navbar-left" action="{{ action("$self@index") }}" method="get">
  <div class="input-group">
    <input class="form-control navbar-search-input" type="text" name="q" value="{{ old('q', @$q) }}" placeholder="{{ trans('torrents.search') }}">
    <span class="input-group-btn">
      <button class="btn btn-default">
        @svg (search)
      </button>
    </span>
  </div>
</form>
@endsection

@section('content_header')
<ul class="nav nav-link-tabs mb-4">
  <li class="{{ $view === 'torrents.index' ? 'active' : '' }}">
    <a href="{{ action('Torrents@index') }}">{{ trans('torrents.new') }}</a>
  </li>
  {{--
  <li class="{{ $view === 'torrents.categories' ? 'active' : '' }}">
    <a href="{{ action('Torrents@categories') }}">{{ trans('torrents.categories') }}</a>
  </li>
  --}}
  <li class="{{ $view === 'torrents.add' ? 'active' : '' }}">
    <a href="{{ action('Torrents@add') }}">{{ trans('torrents.add') }}</a>
  </li>
  <li class="{{ $view === 'torrents.faq' ? 'active' : '' }}">
    <a href="{{ action('Torrents@faq') }}">{{ trans('torrents.faq') }}</a>
  </li>
  <li class="{{ $view === 'torrents.comments' ? 'active' : '' }}">
    <a href="{{ action('Torrents@comments') }}">{{ trans('torrents.comments') }}</a>
  </li>
  @if (Auth::check())
    <li class="{{ $view === 'torrents.my' ? 'active' : '' }}">
      <a href="{{ action('Torrents@my') }}">{{ trans('torrents.my') }}</a>
    </li>
  @endif
</ul>
@endsection
