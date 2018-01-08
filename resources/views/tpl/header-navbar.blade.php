<div class="navbar navbar-default d-none d-sm-block {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'navbar-inverse' : '' }}">
  <div class="container">
    <div class="navbar-collapse">
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
          @ru
            <li>
              <a class="{{ $self == 'Torrents' ? 'navbar-selected' : '' }}" href="{{ path('Torrents@index') }}">
                {{ trans('menu.torrents') }}
              </a>
            </li>
          @endru
          <li>
            <a class="{{ $self == 'Photos' ? 'navbar-selected' : '' }}" href="{{ path('Photos@trips') }}">
              {{ trans('photos.index') }}
            </a>
          </li>
        @show
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <li>
              <a href="{{ path('Auth\SignIn@index') }}">{{ trans('auth.signin') }}</a>
            </li>
          @endif
        @show
      </ul>
    </div>
  </div>
</div>
