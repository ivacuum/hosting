<header class="bg-light dark:bg-slate-900 shadow-box-b shadow-grey-200 dark:shadow-slate-800 {{ $navbarClasses ?? 'hidden md:flex' }}">
  <div class="container">
    <div class="flex flex-wrap justify-between items-stretch w-full">
      @section('brand')
        <a class="site-brand font-bold text-lg text-sky-700 flex items-center leading-none hover:text-(--link-hover-color) md:mr-3 text-center pb-[2px] single-story-a" href="{{ to('/') }}">vacuum<br>kaluga</a>
      @show
      <button class="md:hidden px-4 py-3 text-2xl text-gray-500 hover:text-gray-900 dark:hover:text-gray-300 leading-none js-collapse" data-target="#header_menu">
        @svg (three-bars)
      </button>
      <nav id="header_menu" class="flex md:flex flex-col md:flex-row order-4 md:order-3 md:mr-auto md:items-center whitespace-nowrap md:whitespace-normal w-full md:w-auto hidden">
        @section('global_menu')
          @component('tpl.menu-item', [
            'href' => to('life'),
            'isActive' => Str::of($routeUri)->is(['life', 'life/*']),
          ])
            @lang('Заметки')
          @endcomponent
          @component('tpl.menu-item', [
            'href' => to('news'),
            'isActive' => Str::of($routeUri)->is(['news', 'news/*']),
          ])
            @lang('Новости')
          @endcomponent
          @if (!$isCrawler)
            @ru
              @component('tpl.menu-item', [
                'href' => to('magnets'),
                'isActive' => Str::of($routeUri)->is(['magnets', 'magnets/*']),
              ])
                @lang('Магнеты')
              @endcomponent
            @endru
          @endif
          @component('tpl.menu-item', [
            'href' => to('photos/trips'),
            'isActive' => Str::of($routeUri)->is(['photos', 'photos/*']),
          ])
            @lang('Фотки')
          @endcomponent
        @show
      </nav>
      <nav class="flex md:items-center order-3 md:order-4">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <a
              class="px-2 py-3 text-grey-600 dark:text-slate-400 hover:text-grey-900 dark:hover:text-slate-200"
              href="@lng/auth/login"
            >@lang('auth.signin')</a>
          @endif
        @show
      </nav>
    </div>
  </div>
</header>
