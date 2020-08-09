@extends('base')

@section('content_header')
<div class="nav-link-tabs-fader nav-border -mt-4 mb-4">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a
          class="nav-link {{ $routeUri === 'photos' ? 'active' : '' }}"
          href="@lng/photos"
        >
          @lang('Новые фото')
        </a>
        <a
          class="nav-link {{ Str::of($routeUri)->is(['photos/trips', 'photos/trips/*']) ? 'active' : '' }}"
          href="@lng/photos/trips">
          @lang('Поездки')
        </a>
        <a
          class="nav-link {{ Str::of($routeUri)->is(['photos/tags', 'photos/tags/*']) ? 'active' : '' }}"
          href="@lng/photos/tags">
          @lang('Тэги')
        </a>
        <a
          class="nav-link {{ $routeUri === 'photos/map' ? 'active' : '' }}"
          href="@lng/photos/map">
          @lang('Карта')
        </a>
        <a
          class="nav-link {{ Str::of($routeUri)->is(['photos/cities', 'photos/cities/*']) ? 'active' : '' }}"
          href="@lng/photos/cities">
          @lang('Города')
        </a>
        <a
          class="nav-link {{ Str::of($routeUri)->is(['photos/countries', 'photos/countries/*']) ? 'active' : '' }}"
          href="@lng/photos/countries">
          @lang('Страны')
        </a>
        <a
          class="nav-link {{ $routeUri === 'photos/faq' ? 'active' : '' }}"
          href="@lng/photos/faq">
          @lang('Помощь')
        </a>
      </nav>
    </div>
  </div>
</div>
@endsection
