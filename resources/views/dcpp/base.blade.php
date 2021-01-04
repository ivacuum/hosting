@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
])

@push('head')
@if (App::isProduction())
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif
@endpush

@section('bottom-tabbar')
@endsection

@section('global_menu')
@component('tpl.menu-item', [
  'href' => to('dc'),
  'isActive' => $routeUri === 'dc',
])
  @lang('О DC++')
@endcomponent
@ru
  @component('tpl.menu-item', [
    'href' => to('dc/faq'),
    'isActive' => $routeUri === 'dc/faq',
  ])
    @lang('dcpp.faq')
  @endcomponent
@endru
@component('tpl.menu-item', [
  'href' => to('dc/hubs'),
  'isActive' => $routeUri === 'dc/hubs',
])
  @lang('Хабы')
@endcomponent
<div class="flex md:hidden">
  @component('tpl.menu-item', [
    'href' => to('dc/clients'),
    'isActive' => $routeUri === 'dc/clients',
  ])
    @lang('Клиенты DC++')
  @endcomponent
</div>
<div class="hidden md:flex">
  @component('tpl.menu-dropdown')
    @slot('title')
      @lang('Клиенты')
    @endslot

    <a
      class="dropdown-item"
      href="@lng/dc/airdc"
      role="menuitem"
    >@lang('dcpp.airdc')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/apexdc"
      role="menuitem"
    >@lang('dcpp.apexdc')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/dcpp"
      role="menuitem"
    >@lang('dcpp.dcpp')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/flylinkdc"
      role="menuitem"
    >@lang('dcpp.flylinkdc')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/greylinkdc"
      role="menuitem"
    >@lang('dcpp.greylinkdc')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/jucydc"
      role="menuitem"
    >@lang('dcpp.jucydc')</a>
    @ru
      <a
        class="dropdown-item"
        href="@lng/dc/kalugadc"
        role="menuitem"
      >@lang('dcpp.kalugadc')</a>
    @endru
    <a
      class="dropdown-item"
      href="@lng/dc/pelinkdc"
      role="menuitem"
    >@lang('dcpp.pelinkdc')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/shakespeer"
      role="menuitem"
    >@lang('dcpp.shakespeer')</a>
    <a
      class="dropdown-item"
      href="@lng/dc/strongdc"
      role="menuitem"
    >@lang('dcpp.strongdc')</a>
  @endcomponent
</div>
@ru
  <a
    class="hidden md:block btn btn-success leading-tight text-sm ml-2"
    href="@lng/torrents"
  >
    @lang('Торренты')
  </a>
@endru
@endsection

@section('header_user')
@if (empty($noLanguageSelector))
  @ru
    <a
      class="px-2 py-3 text-grey-600 hover:text-grey-900 whitespace-nowrap"
      href="/en/{{ $requestUri }}"
      lang="en"
    >In English</a>
  @en
    <a
      class="px-2 py-3 text-grey-600 hover:text-grey-900 whitespace-nowrap"
      href="/{{ $requestUri }}"
      lang="ru"
    >По-русски</a>
  @endru
@else
  <div class="w-20"></div>
@endif
@endsection

@section('content_footer')
@if (empty($noFooterBanner))
  <div class="my-4">
    @include('tpl.google-horizontal')
  </div>
@endif
@endsection

@section('footer_container')
@endsection
