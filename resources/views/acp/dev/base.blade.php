@extends('acp.base')

@section('content_header')
<div class="nav-link-tabs-fader nav-border -mt-4 mb-4">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a
          class="nav-link {{ $routeUri === 'acp/dev/templates' ? 'active' : '' }}"
          href="@lng/acp/dev/templates"
        >
          @lang('acp.dev.templates.index')
        </a>
        <a
          class="nav-link {{ $routeUri === 'acp/dev/gig-templates' ? 'active' : '' }}"
          href="@lng/acp/dev/gig-templates"
        >
          @lang('acp.dev.gig-templates.index')
        </a>
        <a
          class="nav-link {{ $routeUri === 'acp/dev/thumbnails' ? 'active' : '' }}"
          href="@lng/acp/dev/thumbnails"
        >
          @lang('acp.dev.thumbnails.index')
        </a>
        <a
          class="nav-link {{ $routeUri === 'acp/dev/logs' ? 'active' : '' }}"
          href="@lng/acp/dev/logs"
        >
          @lang('acp.dev.logs')
        </a>
        <a
          class="nav-link {{ $routeUri === 'acp/dev/svg' ? 'active' : '' }}"
          href="@lng/acp/dev/svg"
        >
          @lang('acp.dev.svg')
        </a>
        @if (App::isLocal() && !Request::cookie('debugbar', false))
          <a
            class="nav-link"
            href="{{ path([App\Http\Controllers\Acp\Dev::class, 'debugbar']) }}"
          >
            @lang('acp.dev.debugbar')
          </a>
        @endif
      </nav>
    </div>
  </div>
</div>
@endsection

@section('content_footer')
@endsection
