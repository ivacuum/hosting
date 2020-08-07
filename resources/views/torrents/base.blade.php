@extends('base')

@section('content_header')
<div class="lg:flex flex-row-reverse items-center justify-between -mt-1 lg:-mt-2 mb-4">
  <form class="flex mb-2 lg:mb-0" action="{{ path([App\Http\Controllers\Torrents::class, 'index']) }}">
    <div class="flex w-full">
      <input
        class="form-input rounded-r-none js-search-input"
        name="q"
        value="{{ request('q') }}"
        enterkeyhint="search"
        placeholder="{{ __('Поиск...') }}"
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
          <a class="nav-link {{ $view === 'torrents.index' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'index']) }}">
            {{ __('Новые раздачи') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.create' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'create']) }}">
            {{ __('Добавить раздачу') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.faq' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'faq']) }}">
            {{ __('Помощь') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.comments' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'comments']) }}">
            {{ __('Комментарии') }}
          </a>
          @if (Auth::check())
            <a class="nav-link {{ $view === 'torrents.my' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'my']) }}">
              {{ __('Мои раздачи') }}
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
