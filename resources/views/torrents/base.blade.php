@extends('base')

@section('content_header')
<div class="lg:flex flex-row-reverse items-center justify-between -mt-1 lg:-mt-2 mb-4">
  <form class="flex mb-2 lg:mb-0" action="@lng/torrents">
    <div class="flex w-full">
      <input
        class="form-input rounded-r-none js-search-input"
        name="q"
        value="{{ request('q') }}"
        enterkeyhint="search"
        placeholder="@lang('Поиск...')"
        autocapitalize="none"
      >
      <button class="btn btn-default -ml-px rounded-l-none">
        @svg (search)
      </button>
    </div>
  </form>
  @yield('torrent-download-button')
  <x-nav-link-tabs>
    <x-nav-link-to href="{{ to('torrents') }}" is-active="{{ $routeUri === 'torrents' }}">
      @lang('Новые раздачи')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('torrents/add') }}" is-active="{{ $routeUri === 'torrents/add' }}">
      @lang('Добавить раздачу')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('torrents/faq') }}" is-active="{{ $routeUri === 'torrents/faq' }}">
      @lang('Помощь')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('torrents/comments') }}" is-active="{{ $routeUri === 'torrents/comments' }}">
      @lang('Комментарии')
    </x-nav-link-to>
    @auth
      <x-nav-link-to href="{{ to('torrents/my') }}" is-active="{{ $routeUri === 'torrents/my' }}">
        @lang('Мои раздачи')
      </x-nav-link-to>
    @endauth
  </x-nav-link-tabs>
</div>
@endsection
