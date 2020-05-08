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
  'href' => path([App\Http\Controllers\Dcpp::class, 'index']),
  'isActive' => $page === 'index',
])
  {{ trans('dcpp.index') }}
@endcomponent
@ru
  @component('tpl.menu-item', [
    'href' => path([App\Http\Controllers\Dcpp::class, 'page'], 'faq'),
    'isActive' => $page === 'faq',
  ])
    {{ trans('dcpp.faq') }}
  @endcomponent
@endru
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Dcpp::class, 'page'], 'hubs'),
  'isActive' => $page === 'hubs',
])
  {{ trans('dcpp.hubs') }}
@endcomponent
<div class="flex md:hidden">
  @component('tpl.menu-item', [
    'href' => path([App\Http\Controllers\Dcpp::class, 'page'], 'clients'),
    'isActive' => $page === 'clients',
  ])
    {{ trans('dcpp.dc_clients') }}
  @endcomponent
</div>
<div class="hidden md:flex">
  @component('tpl.menu-dropdown')
    @slot('title')
      {{ trans('dcpp.clients') }}
    @endslot

    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'airdc') }}"
      role="menuitem"
    >{{ trans('dcpp.airdc') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'apexdc') }}"
      role="menuitem"
    >{{ trans('dcpp.apexdc') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'dcpp') }}"
      role="menuitem"
    >{{ trans('dcpp.dcpp') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'flylinkdc') }}"
      role="menuitem"
    >{{ trans('dcpp.flylinkdc') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'greylinkdc') }}"
      role="menuitem"
    >{{ trans('dcpp.greylinkdc') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'jucydc') }}"
      role="menuitem"
    >{{ trans('dcpp.jucydc') }}</a>
    @ru
      <a
        class="dropdown-item"
        href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'kalugadc') }}"
        role="menuitem"
      >{{ trans('dcpp.kalugadc') }}</a>
    @endru
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'pelinkdc') }}"
      role="menuitem"
    >{{ trans('dcpp.pelinkdc') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'shakespeer') }}"
      role="menuitem"
    >{{ trans('dcpp.shakespeer') }}</a>
    <a
      class="dropdown-item"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'strongdc') }}"
      role="menuitem"
    >{{ trans('dcpp.strongdc') }}</a>
  @endcomponent
</div>
@ru
  <a
    class="hidden md:block btn btn-success leading-tight text-sm ml-2"
    href="{{ path([App\Http\Controllers\Torrents::class, 'index']) }}"
  >
    {{ trans('torrents.index') }}
  </a>
@endru
@endsection

@section('header_user')
@if (empty($noLanguageSelector))
  @ru
    <a
      class="px-2 py-3 text-grey-600 hover:text-grey-900 whitespace-no-wrap"
      href="{{ url("en/{$requestUri}") }}"
      lang="en"
    >In English</a>
  @en
    <a
      class="px-2 py-3 text-grey-600 hover:text-grey-900 whitespace-no-wrap"
      href="{{ url($requestUri) }}"
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
