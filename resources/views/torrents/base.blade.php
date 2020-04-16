@extends('base')

@section('content_header')
<div class="lg:flex flex-row-reverse items-center justify-between -mt-1 lg:-mt-2 mb-4">
  <form class="flex mb-2 lg:mb-0" action="{{ path([App\Http\Controllers\Torrents::class, 'index']) }}">
    <div class="flex w-full">
      <input
        class="form-control rounded-r-none js-search-input"
        name="q"
        value="{{ request('q') }}"
        enterkeyhint="search"
        placeholder="{{ trans('torrents.search') }}"
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
            {{ trans('torrents.new') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.create' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'create']) }}">
            {{ trans('torrents.create') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.faq' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'faq']) }}">
            {{ trans('torrents.faq') }}
          </a>
          <a class="nav-link {{ $view === 'torrents.comments' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'comments']) }}">
            {{ trans('torrents.comments') }}
          </a>
          @if (Auth::check())
            <a class="nav-link {{ $view === 'torrents.my' ? 'active' : '' }}" href="{{ path([App\Http\Controllers\Torrents::class, 'my']) }}">
              {{ trans('torrents.my') }}
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
