<?php
/** @var string $locale */
?>
@if (!Request::pjax())
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
@endif
  <title>{{ ViewHelper::metaTitle($meta_title ?? '', $view, $meta_replace ?? []) }}</title>
@if (!Request::pjax())
  <link rel="dns-prefetch" href="https://life.ivacuum.org">
  <link rel="dns-prefetch" href="https://ivacuum.org">
  <meta http-equiv="x-pjax-version" content="2">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{{ ViewHelper::metaKeywords($meta_keywords ?? '', $view, $meta_replace ?? []) }}">
  <meta name="description" content="{{ ViewHelper::metaDescription($meta_description ?? '', $view, $meta_replace ?? []) }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
  <link rel="icon" href="/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  @yield('pagination_seo')
  @if (Illuminate\Support\Str::contains($css_classes, ['android', 'chrome', 'opera']) && in_array($locale, ['en', 'ru']))
    <link rel="manifest" href="/pwa-manifest-{{ $locale }}.json">
    <script async src="/assets/service-worker-installer.js"></script>
  @endif
  @if (empty($no_language_selector))
    <link rel="alternate" hreflang="en" href="{{ url("en/{$request_uri}") }}">
    <link rel="alternate" hreflang="ru" href="{{ url($request_uri) }}">
  @endif
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  <link rel="stylesheet" href="{{ mix('/assets/tailwind.css') }}">
  @stack('head')
</head>
<body class="{{ $body_classes ?? 'body-with-bottom-tabbar' }} {{ optional(Auth::user())->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ $css_classes }}" data-self="{{ $self }}" data-view="{{ $view }}">
@section('body')
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
      <a class="bottom-tab {{ Illuminate\Support\Str::startsWith(request()->path(), 'my/') ? 'active' : '' }}" href="{{ path('MyProfile@edit') }}">
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
  <div class="{{ $content_container_classes ?? 'container mt-3' }} {{ $content_container_extra_classes ?? '' }}" id="{{ $content_container_id ?? 'pjax_container' }}">

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
      <ul class="list-inline tw-mb-0">
        @section('footer_copyright')
          <li class="list-inline-item">&copy; {{ date('Y') }} vacuum</li>
        @show
        @section('i18n')
          @if (empty($no_language_selector))
            <li class="list-inline-item">
              @ru
                <a class="d-flex flex-wrap align-items-center text-nowrap" href="{{ url("en/{$request_uri}") }}" lang="en">
                  <div class="mr-1">
                    <svg class="flag-16 flag-shadow" viewBox="0 0 640 480" width="16" height="12">
                      <g fill-rule="evenodd">
                        <g stroke-width="1pt">
                          <path fill="#bd3d44" d="M0 0h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0z" transform="scale(.9375)"/>
                          <path fill="#fff" d="M0 39.385h972.81V78.77H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0zm0 78.77h972.81v39.385H0z" transform="scale(.9375)"/>
                        </g>
                        <path fill="#192f5d" d="M0 0h389.12v275.69H0z" transform="scale(.9375)"/>
                        <path fill="#fff" d="M32.427 11.8l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.853 0l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zm64.856 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zm64.852 0l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458zM64.855 39.37l3.54 10.896h11.458L70.583 57l3.542 10.897-9.27-6.734-9.269 6.734L59.126 57l-9.269-6.734h11.458zm64.852 0l3.54 10.896h11.457L135.435 57l3.54 10.897-9.268-6.734-9.27 6.734L123.978 57l-9.27-6.734h11.458zm64.855 0l3.54 10.896h11.458L200.29 57l3.541 10.897-9.27-6.734-9.268 6.734L188.833 57l-9.269-6.734h11.457zm64.855 0l3.54 10.896h11.458L265.145 57l3.541 10.897-9.269-6.734-9.27 6.734L253.69 57l-9.27-6.734h11.458zm64.852 0l3.54 10.896h11.457L329.997 57l3.54 10.897-9.268-6.734-9.27 6.734L318.54 57l-9.27-6.734h11.458zM32.427 66.939l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.853 0l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zm64.856 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zm64.852 0l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458zM64.855 94.508l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm-291.842 27.57l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.853 0l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zm64.856 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zm64.852 0l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458zM64.855 149.647l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm-291.842 27.57l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.853 0l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zm64.856 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zm64.852 0l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458zM64.855 204.786l3.54 10.897h11.458l-9.27 6.734 3.542 10.897-9.27-6.734-9.269 6.734 3.54-10.897-9.269-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.27-6.734-9.268 6.734 3.54-10.897-9.269-6.734h11.457zm64.855 0l3.54 10.897h11.458l-9.27 6.734 3.541 10.897-9.269-6.734-9.27 6.734 3.542-10.897-9.27-6.734h11.458zm64.852 0l3.54 10.897h11.457l-9.269 6.734 3.54 10.897-9.268-6.734-9.27 6.734 3.541-10.897-9.27-6.734h11.458zm-291.842 27.57l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.853 0l3.541 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735H93.74zm64.856 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.269 6.734 3.54-10.896-9.269-6.735h11.458zm64.852 0l3.54 10.896h11.457l-9.269 6.735 3.54 10.896-9.268-6.734-9.27 6.734 3.541-10.896-9.27-6.735h11.458zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.27-6.734-9.268 6.734 3.54-10.896-9.269-6.735h11.457zm64.855 0l3.54 10.896h11.458l-9.27 6.735 3.541 10.896-9.269-6.734-9.27 6.734 3.542-10.896-9.27-6.735h11.458z" transform="scale(.9375)"/>
                      </g>
                    </svg>
                  </div>
                  <div>In English</div>
                </a>
              @en
                <a class="d-flex flex-wrap align-items-center text-nowrap" href="{{ url($request_uri) }}" lang="ru">
                  <div class="mr-1">
                    <svg class="flag-16 flag-shadow" viewBox="0 0 640 480" width="16" height="12">
                      <g fill-rule="evenodd" stroke-width="1pt">
                        <path fill="#fff" d="M0 0h640v480H0z"/>
                        <path fill="#0039a6" d="M0 160.003h640V480H0z"/>
                        <path fill="#d52b1e" d="M0 319.997h640V480H0z"/>
                      </g>
                    </svg>
                  </div>
                  <div>По-русски</div>
                </a>
              @endru
            </li>
          @endif
          <li class="list-inline-item">
            <a href="{{ path('Issues@create') }}">
              {{ trans('issues.create') }}
            </a>
          </li>
        @show
      </ul>
    @show
  </div>
</footer>
@show
<div class="curtain curtain-closed js-curtain"></div>
@show
<script>
window.AppOptions = JSON.parse('<?= json_encode([
  'locale' => $locale,
  'loggedIn' => Auth::check(),
  'csrfToken' => csrf_token(),
  'socketIoHost' => config('cfg.socketio_host'),
  'yandexMetrikaId' => 5266444,
], JSON_HEX_APOS) ?>')
</script>
<script src="{{ mix('/assets/polyfills.js') }}"></script>
<script src="{{ mix('/assets/intersection-observer.js') }}"></script>
<script src="{{ mix('/assets/jquery.js') }}"></script>
<script src="{{ mix('/assets/jquery.pjax.js') }}"></script>
<script src="{{ mix('/assets/jquery.scrollto.js') }}"></script>
<script src="{{ mix('/assets/autosize.js') }}"></script>
<script src="{{ mix('/assets/notie.js') }}"></script>
<script src="{{ mix('/assets/popper.js') }}"></script>
<script src="{{ mix('/assets/bootstrap.js') }}"></script>
<script src="{{ mix('/assets/vue.js') }}"></script>
<script src="{{ mix('/assets/vue-i18n.js') }}"></script>
<script src="{{ mix('/assets/vue-router.js') }}"></script>
<script src="{{ mix('/assets/vuex.js') }}"></script>
<script src="{{ mix('/assets/axios.js') }}"></script>
@if (!empty($websockets))
  <script src="{{ mix('/assets/socket.io.js') }}"></script>
@endif
<script src="{{ mix('/assets/mousetrap.js') }}"></script>
@stack('js_vendor')
<script src="{{ mix('/assets/app.js') }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
@endif
