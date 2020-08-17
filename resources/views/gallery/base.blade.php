@extends('base')

@section('content_header')
@auth
  <div class="-mt-4 mb-6">
    <x-nav-link-tabs>
      <x-nav-link-to href="{{ to('gallery') }}" is-active="{{ $routeUri === 'gallery' }}">
        @lang('Мои изображения')
      </x-nav-link-to>
      <x-nav-link-to href="{{ to('gallery/upload') }}" is-active="{{ $routeUri === 'gallery/upload' }}">
        @lang('Загрузка изображений')
      </x-nav-link-to>
    </x-nav-link-tabs>
  </div>
@endauth
@endsection
