@if (!Request::pjax())
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
@endif
  <title>{{ ViewHelper::metaTitle($meta_title ?? '', $view) }}</title>
@if (!Request::pjax())
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="x-pjax-version" content="2">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="{{ $meta_keywords ?? '' }}">
  <meta name="description" content="{{ $meta_description ?? '' }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="https://life.ivacuum.ru/apple-touch-icon-precomposed.png">
  <link rel="icon" href="https://life.ivacuum.ru/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  <link rel="manifest" href="/pwa-manifest.json?1">
  <script async src="/assets/service-worker-installer.js"></script>
  <link rel="alternate" hreflang="en" href="{{ url("en/{$request_uri}") }}">
  <link rel="alternate" hreflang="ru" href="{{ url($request_uri) }}">
  <link rel="stylesheet" href="/assets/fotorama.css">
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  @stack('head')
</head>
<body class="{{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ ViewHelper::isMobile(Request::server('HTTP_USER_AGENT')) ? 'is-mobile' : 'is-desktop' }}">
<div class="navbar navbar-default {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'navbar-inverse' : '' }}">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @section('brand')
        <a class="navbar-brand" href="{{ path('Home@index') }}">vacuum<br>kaluga</a>
      @show
    </div>
    <div class="navbar-collapse collapse">
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
            <li>
              <a class="tooltipped tooltipped-s {{ $self == 'Notifications' ? 'navbar-selected' : '' }}" href="{{ path('Notifications@index') }}" aria-label="{{ trans('notifications.index') }}">
                @svg (bell)
                <span class="counter-label-round">{{ !is_null(Auth::user()->unreadNotifications()->first()) ? '!' : '' }}</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle avatar-dropdown" data-toggle="dropdown">
                @include('tpl.avatar', ['user' => Auth::user()])
                @svg (angle-down)
              </a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">
                  {{ trans('auth.signed_in_as') }}
                  <span class="font-bold">{{ Auth::user()->displayName() }}</span>
                </li>
                <li class="divider"></li>
                @if (Auth::user()->isAdmin())
                  <li>
                    <a href="{{ App::isLocal() ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips" }}">
                      {{ trans('acp.index') }}
                    </a>
                  </li>
                @endif
                <li>
                  <a href="{{ path('My@profile') }}">
                    {{ trans('my.index') }}
                  </a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="{{ path('Auth@logout') }}">
                    {{ trans('auth.logout') }}
                  </a>
                </li>
              </ul>
            </li>
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
</div>
<div class="container-flex">
  @section('breadcrumbs')
    @include('tpl.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? Breadcrumbs::get()])
  @show
  <div class="container">
    @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

<div id="pjax_container">
@endif
@yield('content_header')
@yield('content')
@yield('content_footer')
@if (!Request::pjax())
</div>

  </div>
</div>
<footer>
  <div class="container">
    @section('footer')
      <ul class="list-inline mb-0">
        <li>&copy; {{ date('Y') }} vacuum</li>
        @section('i18n')
          <li>
            @ru
              <a class="link link-lang" href="{{ url("en/{$request_uri}") }}" lang="en">In&nbsp;english</a>
            @en
              <a class="link link-lang" href="{{ url($request_uri) }}" lang="ru">По-русски</a>
            @endlang
          </li>
        @show
      </ul>
    @show
  </div>
</footer>
<script>
<?php echo 'window.AppOptions = ' . json_encode([
  'locale' => $locale,
  'loggedIn' => Auth::check(),
  'csrfToken' => csrf_token(),
  'yandexMetrikaId' => 5266444,
]); ?>
</script>
<script src="/assets/polyfills.js"></script>
<script src="/assets/jquery.js"></script>
<script src="{{ mix('/assets/jquery.pjax.js') }}"></script>
<script src="/assets/jquery.scrollto.js"></script>
<script src="/assets/autosize.js?3.0.21"></script>
<script src="/assets/bootstrap.js"></script>
<script src="/assets/vue.js?2.3.3"></script>
<script src="/assets/axios.js"></script>
<script src="/assets/fotorama-settings.js"></script>
<script src="/assets/fotorama.js"></script>
<script src="{{ mix('/assets/app.js') }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
@endif
