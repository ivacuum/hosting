<?php
/** @var string $locale */
?>
<!DOCTYPE html>
<html class="h-full overflow-y-scroll" lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
  <title>{{ $metaTitle ?? ViewHelper::metaTitle($routeUri, $metaReplace ?? []) }}</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
  <meta name="keywords" content="{{ $metaKeywords ?? ViewHelper::metaKeywords($routeUri, $metaReplace ?? []) }}">
  <meta name="description" content="{{ $metaDescription ?? ViewHelper::metaDescription($routeUri, $metaReplace ?? []) }}">
  <meta name="theme-color" content="#e7e7e7">
  <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
  <link rel="icon" href="/apple-touch-icon.png">
  <link rel="canonical" href="{{ canonical() }}">
  @yield('pagination_seo')
  <link rel="manifest" href="/pwa-manifest-{{ $locale }}.json">
  <script async src="/service-worker-installer.js"></script>
  @if (empty($noLanguageSelector))
    <link rel="alternate" hreflang="en" href="{{ url("en/{$requestUri}") }}">
    <link rel="alternate" hreflang="ru" href="{{ url($requestUri) }}">
  @endif
  @vite('resources/css/app.css')
  @stack('head')
</head>
<body class="flex flex-col tabular-nums min-h-full dark:bg-slate-950 dark:text-slate-400 {{ $bodyClasses ?? 'body-with-bottom-tabbar' }} {{ $cssClasses }}" data-route="{{ $routeUri }}">
@section('body')
@section('header-navbar')
  @include('tpl.header-navbar')
@show

@section('bottom-tabbar')
<header class="bottom-tabbar-container border-t border-[#dee2e6] dark:border-slate-700 fixed bottom-0 left-0 right-0 pb-[env(safe-area-inset-bottom)] flex items-center justify-center md:hidden revealed">
  <nav class="grid grid-cols-4 leading-none text-center w-full">
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center justify-center no-underline w-full bg-transparent pt-2 pb-1.5 sm:py-3 flex-1 leading-none {{ $routeUri === '/' ? 'active' : '' }}"
      href="{{ to('/') }}"
    >
      <div>
        @svg (home)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Главная')</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1.5 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['life', 'life/*']) ? 'active' : '' }}"
      href="@lng/life"
    >
      <div>
        @svg (file-richtext)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Заметки')</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1.5 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['photos', 'photos/*']) ? 'active' : '' }}"
      href="@lng/photos/trips"
    >
      <div>
        @svg (picture-o)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Фотки')</div>
    </a>
    @if (Auth::check())
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1.5 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['my', 'my/*']) ? 'active' : '' }}"
        href="@lng/my/profile"
      >
        <div>
          @svg (user-circle-o)
        </div>
        <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Профиль')</div>
      </a>
    @else
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1.5 sm:py-3 flex-1 {{ $routeUri === 'auth/login' ? 'active' : '' }}"
        href="@lng/auth/login"
      >
        <div>
          @svg (sign-in)
        </div>
        <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('auth.signin')</div>
      </a>
    @endif
  </nav>
</header>
@show

<div class="flex-[1_0_auto]">
  @section('breadcrumbs')
    @include('tpl.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? Breadcrumbs::get()])
  @show
  <div class="js-flash-notification">
    @if ($firstTimeVisit && !Auth::check() && $locale !== $localePreferred && empty($noLanguageSelector) && !$isCrawler && !in_array($locale, request()->getLanguages()))
      <x-alert-warning-dismissable>
        @ru
          As your browser speaks English, would you like to see the <a class="link" href="{{ url("en/{$requestUri}") }}">English version</a> of this page?
        @en
          Так как ваш браузер на русском языке, предлагаем вам <a class="link" href="{{ url($requestUri) }}">русскую версию</a> этой страницы
        @endru
      </x-alert-warning-dismissable>
    @endif
    @if (Session::has('message'))
      <x-alert-info-dismissable>
        {{ Session::get('message') }}
      </x-alert-info-dismissable>
    @endif
    @if ($errors->has('mail'))
      <x-alert-info>
        {{ $errors->first('mail') }}
      </x-alert-info>
    @endif
  </div>
  <main class="{{ $contentContainerClasses ?? 'container mt-4' }}" id="{{ $contentContainerId ?? 'pjax_container' }}">

@yield('content_header')
@yield('content')
@yield('content_footer')

  </main>
</div>

@section('footer_container')
<footer class="text-gray-500 bg-[#fafafa] dark:bg-slate-900 border-t border-[#dee2e6] dark:border-slate-800 mt-6 py-3 text-2sm min-h-[44px]">
  <div class="container">
    @section('footer')
      <nav class="flex flex-wrap gap-3">
        @section('footer_copyright')
          <div>&copy; {{ date('Y') }} vacuum</div>
        @show
        @section('i18n')
          @if (empty($noLanguageSelector))
            <div>
              @ru
                <a class="flex flex-wrap gap-1 items-center whitespace-nowrap js-english" href="{{ url("en/{$requestUri}") }}" lang="en">
                  <div>
                    @svg (flag/en)
                  </div>
                  <div>In English</div>
                </a>
              @en
                <a class="flex flex-wrap gap-1 items-center whitespace-nowrap js-russian" href="{{ url($requestUri) }}" lang="ru">
                  <div>
                    @svg (flag/ru)
                  </div>
                  <div>По-русски</div>
                </a>
              @endru
            </div>
          @endif
          <div>
            <a href="@lng/contact">
              @lang('Обратная связь')
            </a>
          </div>
          @ru
            <div>
              <a href="@lng/privacy-policy">
                @lang('Конфиденциальность')
              </a>
            </div>
          @endru
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
@vite('node_modules/mousetrap/mousetrap.min.js?commonjs-entry')
@vite('node_modules/@github/details-menu-element/dist/index.js')
@stack('js_vendor')
@vite('resources/js/app.js')
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
