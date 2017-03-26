@extends('base')

@section('content_header')
<ul class="nav nav-link-tabs mb-3">
  <li class="{{ $view === 'photos.index' ? 'active' : '' }}">
    <a href="{{ action('Photos@index') }}">{{ trans('photos.new') }}</a>
  </li>
  <li class="{{ $view === 'photos.tags' ? 'active' : '' }}">
    <a href="{{ action('Photos@tags') }}">{{ trans('photos.tags') }}</a>
  </li>
  <li class="{{ $view === 'photos.map' ? 'active' : '' }}">
    <a href="{{ action('Photos@map') }}">{{ trans('photos.map') }}</a>
  </li>
  <li class="{{ $view === 'photos.cities' ? 'active' : '' }}">
    <a href="{{ action('Photos@cities') }}">{{ trans('photos.cities') }}</a>
  </li>
  <li class="{{ $view === 'photos.countries' ? 'active' : '' }}">
    <a href="{{ action('Photos@countries') }}">{{ trans('photos.countries') }}</a>
  </li>
  <li class="{{ $view === 'photos.faq' ? 'active' : '' }}">
    <a href="{{ action('Photos@faq') }}">{{ trans('photos.faq') }}</a>
  </li>
</ul>
@endsection
