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
<body class="body-with-bottom-tabbar {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ ViewHelper::isMobile(Request::server('HTTP_USER_AGENT')) ? 'is-mobile' : 'is-desktop' }}">

@section('header-navbar')
  @include('tpl.header-navbar')
@show

@section('bottom-tabbar')
<header class="bottom-tabbar-container revealed js-nav-reveal">
  <nav class="bottom-tabbar">
    <a class="bottom-tab {{ $self === 'Home' ? 'active' : '' }}" href="{{ path('Home@index') }}">
      @svg (home)
      <div>{{ trans('menu.home') }}</div>
    </a>
    <a class="bottom-tab {{ $self === 'Life' ? 'active' : '' }}" href="{{ path('Life@index') }}">
      @svg (file-text-o)
      <div>{{ trans('menu.life') }}</div>
    </a>
    <a class="bottom-tab {{ $self === 'Photos' ? 'active' : '' }}" href="{{ path('Photos@trips') }}">
      @svg (picture-o)
      <div>{{ trans('photos.index') }}</div>
    </a>
    @if (Auth::check())
      <a class="bottom-tab {{ $self === 'My' ? 'active' : '' }}" href="{{ path('My@profile') }}">
        @svg (user-circle-o)
        <div>{{ trans('my.profile') }}</div>
      </a>
    @else
      <a class="bottom-tab {{ $view === 'auth.login' ? 'active' : '' }}" href="{{ path('Auth@login') }}">
        @svg (sign-in)
        <div>{{ trans('auth.signin') }}</div>
      </a>
    @endif
  </nav>
</header>
@show

<div class="container-flex">
  @section('breadcrumbs')
    @include('tpl.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? Breadcrumbs::get()])
  @show
  <div class="container">
    <div class="js-flash-notification">
      @if ($first_time_visit && !Auth::check() && $locale !== $locale_preffered)
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          @ru
            Hey, looks like you might find useful the <a class="link" href="{{ url("en/{$request_uri}") }}">english version</a> of this page
          @en
            Похоже, что вам может пригодиться версия этой страницы <a class="link" href="{{ url($request_uri) }}">на русском языке</a>
          @endlang
        </div>
      @endif
      @if (Session::has('message'))
        <div class="alert alert-info js-flash-notification">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          {{ Session::get('message') }}
        </div>
      @endif
    </div>

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
<script src="/assets/jquery.js?3.2.1"></script>
<script src="/assets/jquery.pjax.js?2.0.1"></script>
<script src="/assets/jquery.scrollto.js"></script>
<script src="/assets/autosize.js?3.0.21"></script>
<script src="/assets/bootstrap.js"></script>
<script src="/assets/vue.js?2.3.4"></script>
<script src="/assets/axios.js?0.16.2"></script>
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
