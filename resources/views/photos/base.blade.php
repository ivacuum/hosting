@extends('base')

@section('content_header')
<div class="-mt-2 mb-4">
  <x-nav-link-tabs>
    <x-nav-link-to href="{{ to('photos') }}" is-active="{{ $routeUri === 'photos' }}">
      @lang('Новые фото')
    </x-nav-link-to>
    <x-nav-link-to
      href="{{ to('photos/trips') }}"
      is-active="{{ Str::of($routeUri)->is(['photos/trips', 'photos/trips/*']) }}"
    >
      @lang('Поездки')
    </x-nav-link-to>
    <x-nav-link-to
      href="{{ to('photos/tags') }}"
      is-active="{{ Str::of($routeUri)->is(['photos/tags', 'photos/tags/*']) }}"
    >
      @lang('Тэги')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('photos/map') }}" is-active="{{ $routeUri === 'photos/map' }}">
      @lang('Карта')
    </x-nav-link-to>
    <x-nav-link-to
      href="{{ to('photos/cities') }}"
      is-active="{{ Str::of($routeUri)->is(['photos/cities', 'photos/cities/*']) }}"
    >
      @lang('Города')
    </x-nav-link-to>
    <x-nav-link-to
      href="{{ to('photos/countries') }}"
      is-active="{{ Str::of($routeUri)->is(['photos/countries', 'photos/countries/*']) }}"
    >
      @lang('Страны')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('photos/faq') }}" is-active="{{ $routeUri === 'photos/faq' }}">
      @lang('Помощь')
    </x-nav-link-to>
  </x-nav-link-tabs>
</div>
@endsection
