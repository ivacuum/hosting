@extends('base')

@section('content_header')
<div class="lg:flex flex-row-reverse items-center justify-between -mt-1 lg:-mt-2 mb-4">
  <form class="flex mb-2 lg:mb-0" action="@lng/magnets">
    <div class="flex w-full">
      <input
        class="form-input rounded-r-none js-search-input"
        type="search"
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
  @yield('magnet-download-button')
  <x-nav-link-tabs>
    <x-nav-link-to href="{{ to('magnets') }}" is-active="{{ $routeUri === 'magnets' }}">
      @lang('Новые раздачи')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('magnets/add') }}" is-active="{{ $routeUri === 'magnets/add' }}">
      @lang('Добавить раздачу (меню)')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('magnets/faq') }}" is-active="{{ $routeUri === 'magnets/faq' }}">
      @lang('Помощь')
    </x-nav-link-to>
    <x-nav-link-to href="{{ to('magnets/comments') }}" is-active="{{ $routeUri === 'magnets/comments' }}">
      @lang('Комментарии')
    </x-nav-link-to>
    @auth
      <x-nav-link-to href="{{ to('magnets/my') }}" is-active="{{ $routeUri === 'magnets/my' }}">
        @lang('Мои раздачи')
      </x-nav-link-to>
    @endauth
  </x-nav-link-tabs>
</div>
@endsection
