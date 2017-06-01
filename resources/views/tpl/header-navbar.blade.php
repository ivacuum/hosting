<div class="navbar navbar-default hidden-xs {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'navbar-inverse' : '' }}">
  <div class="container">
    @section('brand')
      <a class="navbar-brand" href="{{ path('Home@index') }}">vacuum<br>kaluga</a>
    @show
    <ul class="nav navbar-nav">
      @section('global_menu')
        <li>
          <a class="{{ $self == 'Life' ? 'navbar-selected' : '' }}" href="{{ path('Life@index') }}">
            {{ trans('menu.life') }}
          </a>
        </li>
        <li>
          <a class="{{ $self == 'News' ? 'navbar-selected' : '' }}" href="{{ path('News@index') }}">
            {{ trans('news.index') }}
          </a>
        </li>
        <li>
          <a class="{{ $self == 'Torrents' ? 'navbar-selected' : '' }}" href="{{ path('Torrents@index') }}">
            {{ trans('menu.torrents') }}
          </a>
        </li>
        <li>
          <a class="{{ $self == 'Photos' ? 'navbar-selected' : '' }}" href="{{ path('Photos@index') }}">
            {{ trans('photos.index') }}
          </a>
        </li>
      @show
    </ul>
    @yield('header_form')
    <ul class="nav navbar-nav navbar-right">
      {{--
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          {{ trans('menu.language') }}
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url("en/{$request_uri}") }}" lang="en">English</a></li>
          <li><a href="{{ url($request_uri) }}" lang="ru">Русский</a></li>
        </ul>
      </li>
      --}}
      @section('header_user')
        @if (Auth::check())
          @include('tpl.header-navbar-user')
        @else
          <li>
            <a href="{{ path('Auth@login') }}">{{ trans('auth.signin') }}</a>
          </li>
          {{--
          <form class="navbar-form navbar-right">
            <a class="btn btn-default" href="{{ path('Auth@login') }}">{{ trans('auth.signin') }}</a>
          </form>
          --}}
        @endif
      @show
    </ul>
  </div>
</div>
