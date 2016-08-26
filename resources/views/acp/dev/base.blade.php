@extends('acp.base')

@section('content_header')
<div class="m-t-1 row">
  <div class="col-sm-3">
    <ul class="list-group list-group-svg">
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.templates') ? 'active' : '' }}" href="{{ action('Acp\Dev@templates') }}">
        Шаблоны поездок
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.thumbnails') ? 'active' : '' }}" href="{{ action('Acp\Dev@thumbnails') }}">
        Миниатюры
      </a>
      <a class="list-group-item {{ 0 === strpos($view, 'acp.dev.svg') ? 'active' : '' }}" href="{{ action('Acp\Dev@svg') }}">
        SVG
      </a>
      @if (App::environment('local') && !Request::cookie('debugbar', false))
        <a class="list-group-item" href="{{ action('Acp\Dev@debugbar') }}">
          Отладка на час
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
