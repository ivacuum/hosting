@extends('base')

@push('head')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-7802683087624570",
    enable_page_level_ads: true
  });
</script>
@endpush

@section('global_menu')
<li>
  <a class="{{ $page === 'index' ? 'navbar-selected' : '' }}" href="{{ action('Dcpp@index') }}">
    {{ trans('dcpp.index') }}
  </a>
</li>
@ru
  <li>
    <a class="{{ $page === 'faq' ? 'navbar-selected' : '' }}" href="{{ action('Dcpp@page', 'faq') }}">
      {{ trans('dcpp.faq') }}
    </a>
  </li>
@endlang
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('dcpp.clients') }} <span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{ action('Dcpp@page', 'airdc') }}">
        {{ trans('dcpp.airdc') }}
      </a>
      <a href="{{ action('Dcpp@page', 'apexdc') }}">
        {{ trans('dcpp.apexdc') }}
      </a>
      <a href="{{ action('Dcpp@page', 'dcpp') }}">
        {{ trans('dcpp.dcpp') }}
      </a>
      <a href="{{ action('Dcpp@page', 'flylinkdc') }}">
        {{ trans('dcpp.flylinkdc') }}
      </a>
      <a href="{{ action('Dcpp@page', 'greylinkdc') }}">
        {{ trans('dcpp.greylinkdc') }}
      </a>
      <a href="{{ action('Dcpp@page', 'jucydc') }}">
        {{ trans('dcpp.jucydc') }}
      </a>
      @ru
        <a href="{{ action('Dcpp@page', 'kalugadc') }}">
          {{ trans('dcpp.kalugadc') }}
        </a>
      @endlang
      <a href="{{ action('Dcpp@page', 'pelinkdc') }}">
        {{ trans('dcpp.pelinkdc') }}
      </a>
      <a href="{{ action('Dcpp@page', 'shakespeer') }}">
        {{ trans('dcpp.shakespeer') }}
      </a>
      <a href="{{ action('Dcpp@page', 'strongdc') }}">
        {{ trans('dcpp.strongdc') }}
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="{{ action('Torrents@index') }}">
    {{ trans('torrents.index') }}
  </a>
</li>
@endsection

@section('header_user')
@endsection

@section('content_footer')
@if (App::environment('production'))
  <div class="mt-3 google-b-horizontal">
    <ins class="adsbygoogle d-block"
         data-ad-client="ca-pub-7802683087624570"
         data-ad-slot="1858304644"
         data-ad-format="auto"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
  </div>
@elseif (App::isLocal())
  <div class="mt-3 banner-local google-b-horizontal"></div>
@endif
@endsection

@section('footer')
<ul class="list-inline mb-0">
  <li>&copy; {{ date('Y') }} ArtFly</li>
  <li>
    <a class="link" href="mailto:{{ config('email.dc') }}">
      {{ trans('menu.feedback') }}
    </a>
  </li>
  @section('i18n')
    <li>
      @ru
        <a class="link link-lang" href="{{ url("en/{$request_uri}") }}" lang="en">In english</a>
      @en
        <a class="link link-lang" href="{{ url($request_uri) }}" lang="ru">По-русски</a>
      @endlang
    </li>
  @show
</ul>
@endsection
