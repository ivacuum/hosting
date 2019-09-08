<header class="bg-light border-b-2 border-gray-200 leading-none {{ $navbar_classes ?? 'hidden md:flex' }}">
  <div class="container">
    <div class="flex flex-wrap justify-between items-center w-full">
      @section('brand')
        <a class="site-brand font-bold text-lg text-blue-700 flex items-center hover:text-orange-600 md:mr-3 h-12 text-center" href="{{ path('Home@index') }}">vacuum<br>kaluga</a>
      @show
      <button class="md:hidden px-4 py-3 text-2xl text-gray-600 hover:text-gray-900 js-collapse" data-target="#header_menu">
        @svg (three-bars)
      </button>
      <nav id="header_menu" class="flex md:flex flex-col md:flex-row order-4 md:order-3 md:mr-auto md:items-center whitespace-no-wrap md:whitespace-normal w-full md:w-auto hidden">
        @section('global_menu')
          @component('tpl.menu-item', ['href' => path('Life@index'), 'isActive' => $self === 'Life'])
            {{ trans('menu.life') }}
          @endcomponent
          @component('tpl.menu-item', ['href' => path('News@index'), 'isActive' => $self === 'News'])
            {{ trans('news.index') }}
          @endcomponent
          @if (!$is_crawler)
            @ru
              @component('tpl.menu-item', ['href' => path('Torrents@index'), 'isActive' => $self === 'Torrents'])
                {{ trans('menu.torrents') }}
              @endcomponent
            @endru
          @endif
          @component('tpl.menu-item', ['href' => path('Photos@trips'), 'isActive' => $self === 'Photos'])
            {{ trans('photos.index') }}
          @endcomponent
        @show
      </nav>
      <nav class="flex md:items-center order-3 md:order-4">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <a class="px-2 py-3 text-gray-600 hover:text-gray-900" href="{{ path('Auth\SignIn@index') }}">{{ trans('auth.signin') }}</a>
          @endif
        @show
      </nav>
    </div>
  </div>
</header>
