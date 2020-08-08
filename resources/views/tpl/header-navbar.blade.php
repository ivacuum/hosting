<header class="bg-light border-b-2 border-grey-200 {{ $navbarClasses ?? 'hidden md:flex' }}">
  <div class="container">
    <div class="flex flex-wrap justify-between items-center w-full">
      @section('brand')
        <a class="site-brand font-bold text-lg text-blueish-700 flex items-center leading-none hover:text-orangeish-600 md:mr-3 h-12 text-center" href="{{ path(App\Http\Controllers\HomeController::class) }}">vacuum<br>kaluga</a>
      @show
      <button class="md:hidden px-4 py-3 text-2xl text-grey-600 hover:text-grey-900 leading-none js-collapse" data-target="#header_menu">
        @svg (three-bars)
      </button>
      <nav id="header_menu" class="flex md:flex flex-col md:flex-row order-4 md:order-3 md:mr-auto md:items-center whitespace-no-wrap md:whitespace-normal w-full md:w-auto hidden">
        @section('global_menu')
          @component('tpl.menu-item', [
            'href' => path([App\Http\Controllers\Life::class, 'index']),
            'isActive' => $controller === App\Http\Controllers\Life::class,
          ])
            {{ __('Заметки') }}
          @endcomponent
          @component('tpl.menu-item', [
            'href' => path([App\Http\Controllers\NewsController::class, 'index']),
            'isActive' => $controller === App\Http\Controllers\NewsController::class,
          ])
            {{ __('Новости') }}
          @endcomponent
          @if (!$isCrawler)
            @ru
              @component('tpl.menu-item', [
                'href' => path([App\Http\Controllers\Torrents::class, 'index']),
                'isActive' => $controller === App\Http\Controllers\Torrents::class,
              ])
                {{ trans('menu.torrents') }}
              @endcomponent
            @endru
          @endif
          @component('tpl.menu-item', [
            'href' => path([App\Http\Controllers\Photos::class, 'trips']),
            'isActive' => $controller === App\Http\Controllers\Photos::class,
          ])
            {{ __('Фотки') }}
          @endcomponent
        @show
      </nav>
      <nav class="flex md:items-center order-3 md:order-4">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <a
              class="px-2 py-3 text-grey-600 hover:text-grey-900"
              href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'index']) }}"
            >{{ trans('auth.signin') }}</a>
          @endif
        @show
      </nav>
    </div>
  </div>
</header>
