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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{{ ViewHelper::metaKeywords($meta_keywords ?? '', $view) }}">
  <meta name="description" content="{{ ViewHelper::metaDescription($meta_description ?? '', $view) }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="https://life.ivacuum.ru/apple-touch-icon-precomposed.png">
  <link rel="icon" href="https://life.ivacuum.ru/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  @if (str_contains($css_classes, ['android', 'chrome', 'opera']))
    <link rel="manifest" href="/pwa-manifest.json?1">
    <script async src="/assets/service-worker-installer.js"></script>
  @endif
  @if (empty($no_language_selector))
    <link rel="alternate" hreflang="en" href="{{ url("en/{$request_uri}") }}">
    <link rel="alternate" hreflang="ru" href="{{ url($request_uri) }}">
  @endif
  <link rel="stylesheet" href="/assets/fotorama/fotorama.css">
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  @stack('head')
</head>
<body class="{{ $body_classes ?? 'body-with-bottom-tabbar' }} {{ optional(Auth::user())->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ $css_classes }}" data-self="{{ $self }}" data-view="{{ $view }}">
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
      <a class="bottom-tab {{ starts_with(request()->path(), 'my/') ? 'active' : '' }}" href="{{ path('MyProfile@edit') }}">
        @svg (user-circle-o)
        <div>{{ trans('my.profile') }}</div>
      </a>
    @else
      <a class="bottom-tab {{ $view === 'auth.login' ? 'active' : '' }}" href="{{ path('Auth\SignIn@index') }}">
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
  <div class="js-flash-notification">
    @if ($first_time_visit && !Auth::check() && $locale !== $locale_preffered && empty($no_language_selector) && !$is_crawler)
      <div class="alert alert-warning my-0 px-0 rounded-0">
        <div class="container">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          @ru
            Hey, looks like you might find useful the <a class="link" href="{{ url("en/{$request_uri}") }}">English version</a> of this page
          @en
            Похоже, что вам может пригодиться версия этой страницы <a class="link" href="{{ url($request_uri) }}">на русском языке</a>
          @endru
        </div>
      </div>
    @endif
    @if (Session::has('message'))
      <div class="alert alert-info my-0 px-0 rounded-0">
        <div class="container">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          {{ Session::get('message') }}
        </div>
      </div>
    @endif
    @if ($errors->has('mail'))
      <div class="alert alert-info my-0 px-0 rounded-0">
        <div class="container">
          {{ $errors->first('mail') }}
        </div>
      </div>
    @endif
  </div>
  <div class="{{ $content_container_class ?? 'container mt-3' }}" id="pjax_container">

@endif
@yield('content_header')
@yield('content')
@yield('content_footer')
@if (!Request::pjax())

  </div>
</div>

@section('footer_container')
<footer class="footer mt-4">
  <div class="container">
    @section('footer')
      <ul class="list-inline mb-0">
        @section('footer_copyright')
          <li class="list-inline-item">&copy; {{ date('Y') }} vacuum</li>
        @show
        @section('i18n')
          @if (empty($no_language_selector))
            <li class="list-inline-item">
              @ru
                <a class="link link-lang" href="{{ url("en/{$request_uri}") }}" lang="en">In&nbsp;English</a>
              @en
                <a class="link link-lang" href="{{ url($request_uri) }}" lang="ru">По-русски</a>
              @endru
            </li>
          @endif
        @show
      </ul>
    @show
  </div>
</footer>
@show
<script>
<?php echo 'window.AppOptions = ' . json_encode([
  'locale' => $locale,
  'loggedIn' => Auth::check(),
  'csrfToken' => csrf_token(),
  'socketIoHost' => config('cfg.socketio_host'),
  'yandexMetrikaId' => 5266444,
]); ?>
</script>
<script src="{{ mix('/assets/polyfills.js') }}"></script>
<script src="{{ mix('/assets/jquery.js') }}"></script>
<script src="{{ mix('/assets/jquery.pjax.js') }}"></script>
<script src="{{ mix('/assets/jquery.scrollto.js') }}"></script>
<script src="{{ mix('/assets/autosize.js') }}"></script>
<script src="{{ mix('/assets/popper.js') }}"></script>
<script src="{{ mix('/assets/bootstrap.js') }}"></script>
<script src="{{ mix('/assets/vue.js') }}"></script>
<script src="{{ mix('/assets/axios.js') }}"></script>
@if (!empty($websockets))
  <script src="{{ mix('/assets/socket.io.js') }}"></script>
@endif
<script src="/assets/fotorama/settings.js"></script>
<script src="/assets/fotorama/fotorama.js"></script>
<script src="{{ mix('/assets/app.js') }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
@endif
