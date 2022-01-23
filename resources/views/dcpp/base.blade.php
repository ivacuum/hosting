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

    <x-dropdown-item href="/dc/airdc">@lang('dcpp.airdc')</x-dropdown-item>
    <x-dropdown-item href="/dc/apexdc">@lang('dcpp.apexdc')</x-dropdown-item>
    <x-dropdown-item href="/dc/dcpp">@lang('dcpp.dcpp')</x-dropdown-item>
    <x-dropdown-item href="/dc/flylinkdc">@lang('dcpp.flylinkdc')</x-dropdown-item>
    <x-dropdown-item href="/dc/greylinkdc">@lang('dcpp.greylinkdc')</x-dropdown-item>
    <x-dropdown-item href="/dc/jucydc">@lang('dcpp.jucydc')</x-dropdown-item>
    @ru
      <x-dropdown-item href="/dc/kalugadc">@lang('dcpp.kalugadc')</x-dropdown-item>
    @endru
    <x-dropdown-item href="/dc/pelinkdc">@lang('dcpp.pelinkdc')</x-dropdown-item>
    <x-dropdown-item href="/dc/shakespeer" >@lang('dcpp.shakespeer')</x-dropdown-item>
    <x-dropdown-item href="/dc/strongdc" >@lang('dcpp.strongdc')</x-dropdown-item>
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
