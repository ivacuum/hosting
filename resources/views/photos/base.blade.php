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
          @lang('Новые фото')
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.trip', 'photos.trips']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'trips']) }}">
          @lang('Поездки')
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.tag', 'photos.tags']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'tags']) }}">
          @lang('Тэги')
        </a>
        <a
          class="nav-link {{ $view === 'photos.map' ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'map']) }}">
          @lang('Карта')
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.cities', 'photos.city']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'cities']) }}">
          @lang('Города')
        </a>
        <a
          class="nav-link {{ in_array($view, ['photos.countries', 'photos.country']) ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'countries']) }}">
          @lang('Страны')
        </a>
        <a
          class="nav-link {{ $view === 'photos.faq' ? 'active' : '' }}"
          href="{{ path([App\Http\Controllers\Photos::class, 'faq']) }}">
          @lang('Помощь')
        </a>
      </nav>
    </div>
  </div>
</div>
@endsection
