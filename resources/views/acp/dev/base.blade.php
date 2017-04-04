@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <ul class="list-group text-center">
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.templates') ? 'active' : '' }}" href="{{ path('Acp\Dev\Templates@index') }}">
        {{ trans('acp.dev.templates.index') }}
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.thumbnails') ? 'active' : '' }}" href="{{ path('Acp\Dev\Thumbnails@index') }}">
        {{ trans('acp.dev.thumbnails.index') }}
      </a>
      <a class="list-group-item {{ starts_with($view, 'acp.dev.logs') ? 'active' : '' }}" href="{{ path('Acp\Dev@logs') }}">
        {{ trans('acp.dev.logs') }}
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.svg') ? 'active' : '' }}" href="{{ path('Acp\Dev@svg') }}">
        {{ trans('acp.dev.svg') }}
      </a>
      @if (App::isLocal() && !Request::cookie('debugbar', false))
        <a class="list-group-item" href="{{ path('Acp\Dev@debugbar') }}">
          {{ trans('acp.dev.debugbar') }}
        </a>
      @endif
    </ul>
  </div>
  <div class="col-sm-9">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
