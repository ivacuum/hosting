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
<div class="nav-item {{ $page === 'index' ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('Dcpp@index') }}">
    {{ trans('dcpp.index') }}
  </a>
</div>
@ru
  <div class="nav-item {{ $page === 'faq' ? 'active' : '' }}">
    <a class="nav-link" href="{{ path('Dcpp@page', 'faq') }}">
      {{ trans('dcpp.faq') }}
    </a>
  </div>
@endru
<div class="nav-item {{ $page === 'hubs' ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('Dcpp@page', 'hubs') }}">
    {{ trans('dcpp.hubs') }}
  </a>
</div>
<div class="nav-item dropdown dropdown-hover tw-mr-2 {{ in_array($page, ['airdc', 'apexdc', 'dcpp', 'flylinkdc', 'greylinkdc', 'jucydc', 'kalugadc', 'pelinkdc', 'shakespeer', 'strongdc']) ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ trans('dcpp.clients') }}</a>
  <div class="dropdown-menu">
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
  </div>
</div>
@ru
  <div class="nav-item d-none d-md-block">
    <a class="btn btn-success btn-sm" href="{{ path('Torrents@index') }}">
      {{ trans('torrents.index') }}
    </a>
  </div>
@endru
@endsection

@section('header_user')
@if (empty($no_language_selector))
  <div class="nav-item">
    @ru
      <a class="nav-link tw-whitespace-no-wrap" href="{{ url("en/{$request_uri}") }}" lang="en">In English</a>
    @en
      <a class="nav-link tw-whitespace-no-wrap" href="{{ url($request_uri) }}" lang="ru">По-русски</a>
    @endru
  </div>
@endif
@endsection

@section('content_footer')
@if (empty($no_footer_banner))
  <div class="tw-my-4">
    @include('tpl.google-horizontal')
  </div>
@endif
@endsection

@section('footer_container')
@endsection
