<?php
/** @var string $locale */
?>
<!DOCTYPE html>
<html class="h-full overflow-y-scroll" lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
  <title>{{ $metaTitle ?? ViewHelper::metaTitle($routeUri, $metaReplace ?? []) }}</title>
  <link rel="dns-prefetch" href="https://life.ivacuum.org">
  <link rel="dns-prefetch" href="https://ivacuum.org">
  <link rel="dns-prefetch" href="https://mc.yandex.ru">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="{{ $metaKeywords ?? ViewHelper::metaKeywords($routeUri, $metaReplace ?? []) }}">
  <meta name="description" content="{{ $metaDescription ?? ViewHelper::metaDescription($routeUri, $metaReplace ?? []) }}">
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
<body class="flex flex-col tabular-nums min-h-full {{ $bodyClasses ?? 'body-with-bottom-tabbar' }} {{ Auth::user()?->theme === App\User::THEME_DARK ? 'theme-dark' : '' }} {{ $cssClasses }}" data-route="{{ $routeUri }}">
@section('body')
@section('header-navbar')
  @include('tpl.header-navbar')
@show

@section('bottom-tabbar')
<header class="bottom-tabbar-container fixed bottom-0 left-0 right-0 flex items-center justify-center md:hidden revealed js-bottom-tabbar-reveal">
  <nav class="flex justify-between leading-none text-center mx-1 w-full">
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 leading-none {{ $routeUri === '/' ? 'active' : '' }}"
      href="{{ to('/') }}"
    >
      <div>
        @svg (home)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Главная')</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['life', 'life/*']) ? 'active' : '' }}"
      href="@lng/life"
    >
      <div>
        @svg (file-richtext)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Заметки')</div>
    </a>
    <a
      class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['photos', 'photos/*']) ? 'active' : '' }}"
      href="@lng/photos/trips"
    >
      <div>
        @svg (picture-o)
      </div>
      <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Фотки')</div>
    </a>
    @if (Auth::check())
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ Str::of($routeUri)->is(['my', 'my/*']) ? 'active' : '' }}"
        href="@lng/my/profile"
      >
        <div>
          @svg (user-circle-o)
        </div>
        <div class="text-2xs sm:text-sm mt-1 sm:mt-0 sm:ml-2">@lang('Профиль')</div>
      </a>
    @else
      <a
        class="bottom-tab flex flex-col sm:flex-row sm:items-center sm:justify-center no-underline w-full bg-transparent pt-2 pb-1 sm:py-3 flex-1 {{ $routeUri === 'auth/login' ? 'active' : '' }}"
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

<div class="flex-h-full">
  @section('breadcrumbs')
    @include('tpl.breadcrumbs', ['breadcrumbs' => $breadcrumbs ?? Breadcrumbs::get()])
  @show
  <div class="js-flash-notification">
    @if ($firstTimeVisit && !Auth::check() && $locale !== $localePreffered && empty($noLanguageSelector) && !$isCrawler && !in_array($locale, request()->getLanguages()))
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
  <main class="{{ $contentContainerClasses ?? 'container mt-4' }} {{ $contentContainerExtraClasses ?? '' }}" id="{{ $contentContainerId ?? 'pjax_container' }}">

@yield('content_header')
@yield('content')
@yield('content_footer')

  </main>
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
                <a class="flex flex-wrap items-center whitespace-nowrap" href="{{ url("en/{$requestUri}") }}" lang="en">
                  <div class="mr-1">
                    @svg (flag/en)
                  </div>
                  <div>In English</div>
                </a>
              @en
                <a class="flex flex-wrap items-center whitespace-nowrap" href="{{ url($requestUri) }}" lang="ru">
                  <div class="mr-1">
                    @svg (flag/ru)
                  </div>
                  <div>По-русски</div>
                </a>
              @endru
            </div>
          @endif
          <div class="mr-3">
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
<script src="{{ mix('/assets/jquery.js') }}"></script>
<script src="{{ mix('/assets/jquery.scrollto.js') }}"></script>
<script src="{{ mix('/assets/autosize.js') }}"></script>
<script src="{{ mix('/assets/notie.js') }}"></script>
<script src="{{ mix('/assets/vue.js') }}"></script>
<script src="{{ mix('/assets/vue-i18n.js') }}"></script>
<script src="{{ mix('/assets/axios.js') }}"></script>
<script src="{{ mix('/assets/mousetrap.js') }}"></script>
<script type="module" src="{{ mix('/assets/details-menu-element.js') }}"></script>
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
