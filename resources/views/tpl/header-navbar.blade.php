<div class="border-b-2 border-gray-200 md:p-0 bg-light {{ $navbar_classes ?? 'hidden md:flex' }}">
  <div class="container">
    <div class="flex flex-wrap items-center w-full">
      @section('brand')
        <a class="site-brand text-lg leading-none text-blue-700 hover:text-orange-600 font-bold mr-3 py-0 text-center" href="{{ path('Home@index') }}">vacuum<br>kaluga</a>
      @show
      <nav class="flex flex-wrap mr-auto md:items-center">
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
      <nav class="flex md:items-center">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <a class="block px-2 py-3 text-gray-600 hover:text-gray-900" href="{{ path('Auth\SignIn@index') }}">{{ trans('auth.signin') }}</a>
          @endif
        @show
      </nav>
    </div>
  </div>
</div>
