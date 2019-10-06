@extends('base')

@section('content_header')
<div class="nav-link-tabs-fader nav-border -mt-4 mb-4">
  <div class="nav-scroll-container">
    <div class="nav-scroll">
      <nav class="nav nav-link-tabs">
        <a
          class="nav-link {{ $view === 'photos.index' ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'index']) }}"
        >
          {{ trans('photos.new') }}
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.trip', 'photos.trips']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'trips']) }}">
          {{ trans('photos.trips') }}
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.tag', 'photos.tags']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'tags']) }}">
          {{ trans('photos.tags') }}
        </a>
        <a
          class="nav-link {{ $view === 'photos.map' ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'map']) }}">
          {{ trans('photos.map') }}
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.cities', 'photos.city']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'cities']) }}">
          {{ trans('photos.cities') }}
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.countries', 'photos.country']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'countries']) }}">
          {{ trans('photos.countries') }}
        </a>
        <a
          class="nav-link {{ $view === 'photos.faq' ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'faq']) }}">
          {{ trans('photos.faq') }}
        </a>
      </nav>
    </div>
  </div>
</div>
@endsection
