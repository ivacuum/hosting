@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
])

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
    href="@lng/magnets"
  >
    @lang('Магнеты')
  </a>
@endru
@endsection

@section('header_user')
@if (array_any($pageLanguageLinks, fn (array $link) => $link['locale'] !== $locale))
  @include('tpl.language-selector', [
    'links' => $pageLanguageLinks,
    'linkClasses' => 'px-2 py-3 text-grey-600 dark:text-slate-400 hover:text-grey-900 dark:hover:text-slate-200',
  ])
@else
  <div class="w-20"></div>
@endif
@endsection

@section('footer_container')
@endsection
