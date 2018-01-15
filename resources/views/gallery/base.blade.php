@extends('base')

@section('content_header')
@if (Auth::check())
  <div class="nav-link-tabs-fader nav-border mt--3 mb-4">
    <div class="nav-scroll-container">
      <div class="nav-scroll">
        <nav class="nav nav-link-tabs">
          <a class="nav-link {{ $view === 'gallery.index' ? 'active' : '' }}" href="{{ path('Gallery@index') }}">
            {{ trans('gallery.my') }}
          </a>
          <a class="nav-link {{ $view === 'gallery.upload' ? 'active' : '' }}" href="{{ path('Gallery@upload') }}">
            {{ trans('gallery.upload') }}
          </a>
        </nav>
      </div>
    </div>
  </div>
@endif
@endsection
