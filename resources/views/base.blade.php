@if (!Request::pjax())
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
@endif
  <title>{{ ViewHelper::metaTitle($meta_title ?? '', $view, $meta_replace ?? []) }}</title>
@if (!Request::pjax())
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="x-pjax-version" content="2">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{{ ViewHelper::metaKeywords($meta_keywords ?? '', $view, $meta_replace ?? []) }}">
  <meta name="description" content="{{ ViewHelper::metaDescription($meta_description ?? '', $view, $meta_replace ?? []) }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="https://life.ivacuum.ru/apple-touch-icon-precomposed.png">
  <link rel="icon" href="https://life.ivacuum.ru/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  @if (str_contains($css_classes, ['android', 'chrome', 'opera']) && in_array($locale, ['en', 'ru']))
    <link rel="manifest" href="/pwa-manifest-{{ $locale }}.json">
    <script async src="/assets/service-worker-installer.js"></script>
  @endif
  @if (empty($no_language_selector))
    <link rel="alternate" hreflang="en" href="{{ url("en/{$request_uri}") }}">
    <link rel="alternate" hreflang="ru" href="{{ url($request_uri) }}">
  @endif
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  @stack('head')
</head>
<body class="{{ $body_classes ?? 'body-with-bottom-tabbar' }} {{ optional(Auth::user())->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ $css_classes }}" data-self="{{ $self }}" data-view="{{ $view }}">
@section('header-navbar')
  @include('tpl.header-navbar')
@show

@section('bottom-tabbar')
<header class="bottom-tabbar-container revealed js-bottom-tabbar-reveal">
  <nav class="bottom-tabbar">
    <a class="bottom-tab {{ $self === 'Home' ? 'active' : '' }}" href="{{ path('Home@index') }}">
      <div>
        @svg (home)
      </div>
      <div class="bottom-tab-label">{{ trans('menu.home') }}</div>
    </a>
    <a class="bottom-tab {{ $self === 'Life' ? 'active' : '' }}" href="{{ path('Life@index') }}">
      <div>
        @svg (file-text-o)
      </div>
      <div class="bottom-tab-label">{{ trans('menu.life') }}</div>
    </a>
    <a class="bottom-tab {{ $self === 'Photos' ? 'active' : '' }}" href="{{ path('Photos@trips') }}">
      <div>
        @svg (picture-o)
      </div>
      <div class="bottom-tab-label">{{ trans('photos.index') }}</div>
    </a>
    @if (Auth::check())
      <a class="bottom-tab {{ starts_with(request()->path(), 'my/') ? 'active' : '' }}" href="{{ path('MyProfile@edit') }}">
        <div>
          @svg (user-circle-o)
        </div>
        <div class="bottom-tab-label">{{ trans('my.profile') }}</div>
      </a>
    @else
      <a class="bottom-tab {{ $view === 'auth.login' ? 'active' : '' }}" href="{{ path('Auth\SignIn@index') }}">
        <div>
          @svg (sign-in)
        </div>
        <div class="bottom-tab-label">{{ trans('auth.signin') }}</div>
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
  <div class="{{ $content_container_classes ?? 'container mt-3' }} {{ $content_container_extra_classes ?? '' }}" id="pjax_container">

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
                <a class="d-flex flex-wrap align-items-center text-nowrap" href="{{ url("en/{$request_uri}") }}" lang="en">
                  <img class="flag-16 flag-shadow mr-1" src="https://ivacuum.org/i/flags/svg/us.svg">
                  In English
                </a>
              @en
                <a class="d-flex flex-wrap align-items-center text-nowrap" href="{{ url($request_uri) }}" lang="ru">
                  <img class="flag-16 flag-shadow mr-1" src="https://ivacuum.org/i/flags/svg/ru.svg">
                  По-русски
                </a>
              @endru
            </li>
          @endif
        @show
      </ul>
    @show
  </div>
</footer>
@show
<div class="curtain curtain-closed js-curtain"></div>
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
<script src="{{ mix('/assets/intersection-observer.js') }}"></script>
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
<script src="{{ mix('/assets/mousetrap.js') }}"></script>
<script src="{{ mix('/assets/app.js') }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
@endif
