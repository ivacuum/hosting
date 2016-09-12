@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <ul class="list-group list-group-svg">
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.templates') ? 'active' : '' }}" href="{{ action('Acp\Dev\Templates@index') }}">
        {{ trans('acp.dev.templates.index') }}
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.thumbnails') ? 'active' : '' }}" href="{{ action('Acp\Dev\Thumbnails@index') }}">
        {{ trans('acp.dev.thumbnails.index') }}
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.svg') ? 'active' : '' }}" href="{{ action('Acp\Dev@svg') }}">
        {{ trans('acp.dev.svg') }}
      </a>
      @if (App::environment('local') && !Request::cookie('debugbar', false))
        <a class="list-group-item" href="{{ action('Acp\Dev@debugbar') }}">
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
