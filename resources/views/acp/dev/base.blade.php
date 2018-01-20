@extends('acp.base')

@section('content_header')
<div class="nav-link-tabs-fader nav-border mt-n3 mb-3">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a class="nav-link {{ 0 === strpos($view, 'acp.dev.templates') ? 'active' : '' }}" href="{{ path('Acp\Dev\Templates@index') }}">
          {{ trans('acp.dev.templates.index') }}
        </a>
        <a class="nav-link {{ 0 === strpos($view, 'acp.dev.thumbnails') ? 'active' : '' }}" href="{{ path('Acp\Dev\Thumbnails@index') }}">
          {{ trans('acp.dev.thumbnails.index') }}
        </a>
        <a class="nav-link {{ starts_with($view, 'acp.dev.logs') ? 'active' : '' }}" href="{{ path('Acp\Dev@logs') }}">
          {{ trans('acp.dev.logs') }}
        </a>
        <a class="nav-link {{ 0 === strpos($view, 'acp.dev.svg') ? 'active' : '' }}" href="{{ path('Acp\Dev@svg') }}">
          {{ trans('acp.dev.svg') }}
        </a>
        @if (App::isLocal() && !Request::cookie('debugbar', false))
          <a class="nav-link" href="{{ path('Acp\Dev@debugbar') }}">
            {{ trans('acp.dev.debugbar') }}
          </a>
        @endif
      </nav>
    </div>
  </div>
</div>
@endsection

@section('content_footer')
@endsection
