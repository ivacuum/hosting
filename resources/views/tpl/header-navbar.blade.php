<div class="navbar navbar-border navbar-expand-md py-md-0 {{ $navbar_classes ?? 'd-none d-md-flex' }} {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'navbar-dark text-light' : 'navbar-light bg-light' }}">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      @section('brand')
        <a class="navbar-brand font-weight-bold py-md-0 text-center" href="{{ path('Home@index') }}">vacuum<br>kaluga</a>
      @show
      <ul class="navbar-nav mr-auto align-items-md-center">
        @section('global_menu')
          <li class="nav-item {{ $self == 'Life' ? 'active' : '' }}">
            <a class="nav-link" href="{{ path('Life@index') }}">
              {{ trans('menu.life') }}
            </a>
          </li>
          <li class="nav-item {{ $self == 'News' ? 'active' : '' }}">
            <a class="nav-link" href="{{ path('News@index') }}">
              {{ trans('news.index') }}
            </a>
          </li>
          @ru
            <li class="nav-item {{ $self == 'Torrents' ? 'active' : '' }}">
              <a class="nav-link" href="{{ path('Torrents@index') }}">
                {{ trans('menu.torrents') }}
              </a>
            </li>
          @endru
          <li class="nav-item {{ $self == 'Photos' ? 'active' : '' }}">
            <a class="nav-link" href="{{ path('Photos@trips') }}">
              {{ trans('photos.index') }}
            </a>
          </li>
        @show
      </ul>
      <ul class="navbar-nav align-items-md-center">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ path('Auth\SignIn@index') }}">{{ trans('auth.signin') }}</a>
            </li>
          @endif
        @show
      </ul>
    </div>
  </div>
</div>
