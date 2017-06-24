@extends('base')

@section('content_header')
<ul class="nav nav-link-tabs mb-3">
  <li class="{{ $view === 'photos.index' ? 'active' : '' }}">
    <a href="{{ path('Photos@index') }}">{{ trans('photos.new') }}</a>
  </li>
  <li class="{{ $view === 'photos.trips' ? 'active' : '' }}">
    <a href="{{ path('Photos@trips') }}">{{ trans('photos.trips') }}</a>
  </li>
  <li class="{{ $view === 'photos.tags' ? 'active' : '' }}">
    <a href="{{ path('Photos@tags') }}">{{ trans('photos.tags') }}</a>
  </li>
  <li class="{{ $view === 'photos.map' ? 'active' : '' }}">
    <a href="{{ path('Photos@map') }}">{{ trans('photos.map') }}</a>
  </li>
  <li class="{{ $view === 'photos.cities' ? 'active' : '' }}">
    <a href="{{ path('Photos@cities') }}">{{ trans('photos.cities') }}</a>
  </li>
  <li class="{{ $view === 'photos.countries' ? 'active' : '' }}">
    <a href="{{ path('Photos@countries') }}">{{ trans('photos.countries') }}</a>
  </li>
  <li class="{{ $view === 'photos.faq' ? 'active' : '' }}">
    <a href="{{ path('Photos@faq') }}">{{ trans('photos.faq') }}</a>
  </li>
</ul>
@endsection
