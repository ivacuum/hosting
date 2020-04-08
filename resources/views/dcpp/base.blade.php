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
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'airdc') }}"
    >{{ trans('dcpp.airdc') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'apexdc') }}"
    >{{ trans('dcpp.apexdc') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'dcpp') }}"
    >{{ trans('dcpp.dcpp') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'flylinkdc') }}"
    >{{ trans('dcpp.flylinkdc') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'greylinkdc') }}"
    >{{ trans('dcpp.greylinkdc') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'jucydc') }}"
    >{{ trans('dcpp.jucydc') }}</a>
    @ru
      <a
        class="dropdown-item-tw"
        href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'kalugadc') }}"
      >{{ trans('dcpp.kalugadc') }}</a>
    @endru
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'pelinkdc') }}"
    >{{ trans('dcpp.pelinkdc') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'shakespeer') }}"
    >{{ trans('dcpp.shakespeer') }}</a>
    <a
      class="dropdown-item-tw"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'strongdc') }}"
    >{{ trans('dcpp.strongdc') }}</a>
  @endcomponent
</div>
@ru
  <a
    class="hidden md:block btn btn-success text-sm ml-2 py-2"
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
      class="px-2 py-4 text-grey-600 hover:text-grey-900 whitespace-no-wrap"
      href="{{ url("en/{$requestUri}") }}"
      lang="en"
    >In English</a>
  @en
    <a
      class="px-2 py-4 text-grey-600 hover:text-grey-900 whitespace-no-wrap"
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
