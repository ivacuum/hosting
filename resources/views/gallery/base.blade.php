@extends('base')

@section('content_header')
@if (Auth::check())
  <div class="nav-link-tabs-fader nav-border -mt-4 mb-6">
    <div class="nav-scroll-container">
      <div class="nav-scroll">
        <nav class="nav nav-link-tabs">
          <a
            class="nav-link {{ $routeUri === 'gallery' ? 'active' : '' }}"
            href="@lng/gallery"
          >
            @lang('Мои изображения')
          </a>
          <a
            class="nav-link {{ $routeUri === 'gallery/upload' ? 'active' : '' }}"
            href="@lng/gallery/upload"
          >
            @lang('Загрузка изображений')
          </a>
        </nav>
      </div>
    </div>
  </div>
@endif
@endsection
