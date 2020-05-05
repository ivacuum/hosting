<?php
/** @var string $locale */
?>
<!DOCTYPE html>
<html class="h-full overflow-y-scroll" lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
  <title>{{ $metaTitle ?? ViewHelper::metaTitle($view, $metaReplace ?? []) }}</title>
  <link rel="dns-prefetch" href="https://life.ivacuum.org">
  <link rel="dns-prefetch" href="https://ivacuum.org">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{{ $metaKeywords ?? ViewHelper::metaKeywords($view, $metaReplace ?? []) }}">
  <meta name="description" content="{{ $metaDescription ?? ViewHelper::metaDescription($view, $metaReplace ?? []) }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
  <link rel="icon" href="/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  @yield('pagination_seo')
  @if (Str::contains($cssClasses, ['android', 'chrome', 'opera']) && in_array($locale, ['en', 'ru']))
    <link rel="manifest" href="/pwa-manifest-{{ $locale }}.json">
    <script async src="/assets/service-worker-installer.js"></script>
  @endif
  @if (empty($noLanguageSelector))
    <link rel="alternate" hreflang="en" href="{{ url("en/{$requestUri}") }}">
    <link rel="alternate" hreflang="ru" href="{{ url($requestUri) }}">
  @endif
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  <link rel="stylesheet" href="{{ mix('/assets/tailwind.css') }}">
  @stack('head')
</head>
<body class="flex flex-col font-tabular-nums min-h-full {{ $bodyClasses ?? 'body-with-bottom-tabbar' }} {{ optional(Auth::user())->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ $cssClasses }}" data-self="{{ $self }}" data-view="{{ $view }}">
@section('body')
@section('header-navbar')
  @include('tpl.header-navbar')
@show

@section('bottom-tabbar')
<header class="bottom-tabbar-container fixed bottom-0 left-0 right-0 flex items-center justify-center md:hidden revealed js-bottom-tabbar-reveal">
  <nav class="flex justify-between leading-none text-center mx-1 w-full">
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 leading-none {{ $controller === App\Http\Controllers\HomeController::class ? 'active' : '' }}"
      href="{{ path(App\Http\Controllers\HomeController::class) }}"
    >
      <div>
        @svg (home)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">{{ trans('menu.home') }}</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ $controller === App\Http\Controllers\Life::class ? 'active' : '' }}"
      href="{{ path([App\Http\Controllers\Life::class, 'index']) }}"
    >
      <div>
        @svg (file-richtext)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">{{ trans('menu.life') }}</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ $controller === App\Http\Controllers\Photos::class ? 'active' : '' }}"
      href="{{ path([App\Http\Controllers\Photos::class, 'trips']) }}"
    >
      <div>
        @svg (picture-o)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">{{ trans('photos.index') }}</div>
    </a>
    @if (Auth::check())
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ Str::startsWith(request()->path(), 'my/') ? 'active' : '' }}"
        href="{{ path([App\Http\Controllers\MyProfile::class, 'edit']) }}"
      >
        <div>
          @svg (user-circle-o)
        </div>
        <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">{{ trans('my.profile') }}</div>
      </a>
    @else
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ $controller === App\Http\Controllers\Auth\SignIn::class ? 'active' : '' }}"
        href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'index']) }}"
      >
        <div>
          @svg (sign-in)
        </div>
        <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">{{ trans('auth.signin') }}</div>
      </a>
    @endif
  </nav>
</header>
@show

<div class="flex-h-full">
  @section('breadcrumbs')
    @include('tpl.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? Breadcrumbs::get()])
  @show
  <div class="js-flash-notification">
    @if ($firstTimeVisit && !Auth::check() && $locale !== $localePreffered && empty($noLanguageSelector) && !$isCrawler)
      <div class="alert alert-warning my-0 px-0 rounded-none">
        <div class="container flex">
          <div class="mr-auto">
            @ru
              Hey, looks like you might find useful the <a class="link" href="{{ url("en/{$requestUri}") }}">English version</a> of this page
            @en
              Похоже, что вам может пригодиться версия этой страницы <a class="link" href="{{ url($requestUri) }}">на русском языке</a>
            @endru
          </div>
          <div>
            <button type="button" class="border-0 bg-transparent appearance-none cursor-pointer leading-none text-xl p-0 opacity-50 hover:opacity-75 hover:no-underline" data-dismiss="alert">&times;</button>
          </div>
        </div>
      </div>
    @endif
    @if (Session::has('message'))
      <div class="alert alert-info my-0 px-0 rounded-none">
        <div class="container flex">
          <div class="mr-auto">
            {{ Session::get('message') }}
          </div>
          <div>
            <button type="button" class="border-0 bg-transparent appearance-none cursor-pointer leading-none text-xl p-0 opacity-50 hover:opacity-75 hover:no-underline" data-dismiss="alert">&times;</button>
          </div>
        </div>
      </div>
    @endif
    @if ($errors->has('mail'))
      <div class="alert alert-info my-0 px-0 rounded-none">
        <div class="container">
          {{ $errors->first('mail') }}
        </div>
      </div>
    @endif
  </div>
  <div class="{{ $contentContainerClasses ?? 'container mt-4' }} {{ $contentContainerExtraClasses ?? '' }}" id="{{ $contentContainerId ?? 'pjax_container' }}">

@yield('content_header')
@yield('content')
@yield('content_footer')

  </div>
</div>

@section('footer_container')
<footer class="footer mt-6 py-3 text-2sm">
  <div class="container">
    @section('footer')
      <nav class="flex flex-wrap">
        @section('footer_copyright')
          <div class="mr-3">&copy; {{ date('Y') }} vacuum</div>
        @show
        @section('i18n')
          @if (empty($noLanguageSelector))
            <div class="mr-3">
              @ru
                <a class="flex flex-wrap items-center whitespace-no-wrap" href="{{ url("en/{$requestUri}") }}" lang="en">
                  <div class="mr-1">
                    @svg (flag/en)
                  </div>
                  <div>In English</div>
                </a>
              @en
                <a class="flex flex-wrap items-center whitespace-no-wrap" href="{{ url($requestUri) }}" lang="ru">
                  <div class="mr-1">
                    @svg (flag/ru)
                  </div>
                  <div>По-русски</div>
                </a>
              @endru
            </div>
          @endif
          <div>
            <a href="{{ path([App\Http\Controllers\Issues::class, 'create']) }}">
              {{ trans('issues.create') }}
            </a>
          </div>
        @show
      </nav>
    @show
  </div>
</footer>
@show
@show
<script>
window.AppOptions = JSON.parse('<?= json_encode([
  'locale' => $locale,
  'loggedIn' => Auth::check(),
  'csrfToken' => csrf_token(),
  'yandexMetrikaId' => 5266444,
], JSON_HEX_APOS) ?>')
</script>
<script src="{{ mix('/assets/polyfills.js') }}"></script>
<script src="{{ mix('/assets/intersection-observer.js') }}"></script>
<script src="{{ mix('/assets/jquery.js') }}"></script>
<script src="{{ mix('/assets/jquery.scrollto.js') }}"></script>
<script src="{{ mix('/assets/autosize.js') }}"></script>
<script src="{{ mix('/assets/notie.js') }}"></script>
<script src="{{ mix('/assets/popper.js') }}"></script>
<script src="{{ mix('/assets/bootstrap.js') }}"></script>
<script src="{{ mix('/assets/vue.js') }}"></script>
<script src="{{ mix('/assets/vue-i18n.js') }}"></script>
<script src="{{ mix('/assets/axios.js') }}"></script>
<script src="{{ mix('/assets/mousetrap.js') }}"></script>
<script src="{{ mix('/assets/details-menu-element.js') }}"></script>
@stack('js_vendor')
@if ($locale !== 'ru')
<script>window.livewire_app_url = '/{{ $locale }}'</script>
@endif
<script src="{{ mix('/assets/app.js') }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
