@extends('acp.base')

@section('content_header')
<div class="-mt-4 mb-4">
  <x-nav-link-tabs>
    <x-nav-link-to href="{{ to('acp/dev/templates') }}" is-active="{{ $routeUri === 'acp/dev/templates' }}">
      @lang('acp.dev.templates.index')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('acp/dev/gig-templates') }}" is-active="{{ $routeUri === 'acp/dev/gig-templates' }}">
      @lang('acp.dev.gig-templates.index')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('acp/dev/thumbnails') }}" is-active="{{ $routeUri === 'acp/dev/thumbnails' }}">
      @lang('acp.dev.thumbnails.index')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('acp/dev/logs') }}" is-active="{{ $routeUri === 'acp/dev/logs' }}">
      @lang('acp.dev.logs')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('acp/dev/svg') }}" is-active="{{ $routeUri === 'acp/dev/svg' }}">
      @lang('acp.dev.svg')
    </x-nav-link-to>
    @if (App::isLocal() && !Request::cookie('debugbar', false))
      <x-nav-link-to href="{{ to('acp/dev/debugbar') }}">
        @lang('acp.dev.debugbar')
      </x-nav-link-to>
    @endif
  </x-nav-link-tabs>
</div>
@endsection

@section('content_footer')
@endsection
