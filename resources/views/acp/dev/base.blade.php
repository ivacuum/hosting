@extends('acp.base')

@section('content_header')
<div class="nav-link-tabs-fader nav-border -mt-4 mb-4">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a
          class="nav-link {{ 0 === strpos($view, 'acp.dev.templates') ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Acp\Dev\Templates::class, 'index']) }}"
        >
          {{ trans('acp.dev.templates.index') }}
        </a>
        <a
          class="nav-link {{ 0 === strpos($view, 'acp.dev.thumbnails') ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Acp\Dev\Thumbnails::class, 'index']) }}"
        >
          {{ trans('acp.dev.thumbnails.index') }}
        </a>
        <a
          class="nav-link {{ Str::startsWith($view, 'acp.dev.logs') ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Acp\Dev::class, 'logs']) }}"
        >
          {{ trans('acp.dev.logs') }}
        </a>
        <a
          class="nav-link {{ 0 === strpos($view, 'acp.dev.svg') ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Acp\Dev::class, 'svg']) }}"
        >
          {{ trans('acp.dev.svg') }}
        </a>
        @if (App::isLocal() && !Request::cookie('debugbar', false))
          <a
            class="nav-link"
            href="{{ path([App\Http\Controllers\Acp\Dev::class, 'debugbar']) }}"
          >
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
