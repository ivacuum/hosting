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
  <div class="nav-link-tabs-fader nav-border">
    <div class="nav-scroll-container">
      <div class="nav-scroll">
        <nav class="nav nav-link-tabs">
          <a
            class="nav-link {{ $routeUri === 'torrents' ? 'active' : '' }}"
            href="@lng/torrents"
          >
            @lang('Новые раздачи')
          </a>
          <a
            class="nav-link {{ $routeUri === 'torrents/add' ? 'active' : '' }}"
            href="@lng/torrents/add"
          >
            @lang('Добавить раздачу')
          </a>
          <a
            class="nav-link {{ $routeUri === 'torrents/faq' ? 'active' : '' }}"
            href="@lng/torrents/faq"
          >
            @lang('Помощь')
          </a>
          <a
            class="nav-link {{ $routeUri === 'torrents/comments' ? 'active' : '' }}"
            href="@lng/torrents/comments"
          >
            @lang('Комментарии')
          </a>
          @if (Auth::check())
            <a
              class="nav-link {{ $routeUri === 'torrents/my' ? 'active' : '' }}"
              href="@lng/torrents/my"
            >
              @lang('Мои раздачи')
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
