@extends('base', [
  'body_classes' => '',
  'navbar_classes' => '',
])

@push('head')
@if (App::environment() === 'production')
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endif
@endpush

@section('bottom-tabbar')
@endsection

@section('global_menu')
@component('tpl.menu-item', ['href' => path('Dcpp@index'), 'isActive' => $page === 'index'])
  {{ trans('dcpp.index') }}
@endcomponent
@ru
  @component('tpl.menu-item', ['href' => path('Dcpp@page', 'faq'), 'isActive' => $page === 'faq'])
    {{ trans('dcpp.faq') }}
  @endcomponent
@endru
@component('tpl.menu-item', ['href' => path('Dcpp@page', 'hubs'), 'isActive' => $page === 'hubs'])
  {{ trans('dcpp.hubs') }}
@endcomponent
@component('tpl.menu-dropdown', ['isActive' => in_array($page, ['airdc', 'apexdc', 'dcpp', 'flylinkdc', 'greylinkdc', 'jucydc', 'kalugadc', 'pelinkdc', 'shakespeer', 'strongdc'])])
  @slot('title')
    {{ trans('dcpp.clients') }}
  @endslot

  <a class="dropdown-item" href="{{ path('Dcpp@page', 'airdc') }}">{{ trans('dcpp.airdc') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'apexdc') }}">{{ trans('dcpp.apexdc') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'dcpp') }}">{{ trans('dcpp.dcpp') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'flylinkdc') }}">{{ trans('dcpp.flylinkdc') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'greylinkdc') }}">{{ trans('dcpp.greylinkdc') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'jucydc') }}">{{ trans('dcpp.jucydc') }}</a>
  @ru
    <a class="dropdown-item" href="{{ path('Dcpp@page', 'kalugadc') }}">{{ trans('dcpp.kalugadc') }}</a>
  @endru
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'pelinkdc') }}">{{ trans('dcpp.pelinkdc') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'shakespeer') }}">{{ trans('dcpp.shakespeer') }}</a>
  <a class="dropdown-item" href="{{ path('Dcpp@page', 'strongdc') }}">{{ trans('dcpp.strongdc') }}</a>
@endcomponent
@ru
  <a class="hidden md:block btn btn-success text-sm ml-2 py-1" href="{{ path('Torrents@index') }}">
    {{ trans('torrents.index') }}
  </a>
@endru
@endsection

@section('header_user')
@if (empty($no_language_selector))
  @ru
    <a class="block px-2 py-3 text-gray-600 hover:text-gray-900 whitespace-no-wrap" href="{{ url("en/{$request_uri}") }}" lang="en">In English</a>
  @en
    <a class="block px-2 py-3 text-gray-600 hover:text-gray-900 whitespace-no-wrap" href="{{ url($request_uri) }}" lang="ru">По-русски</a>
  @endru
@endif
@endsection

@section('content_footer')
@if (empty($no_footer_banner))
  <div class="my-4">
    @include('tpl.google-horizontal')
  </div>
@endif
@endsection

@section('footer_container')
@endsection
