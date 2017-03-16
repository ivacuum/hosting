@extends('base')

@section('content_header')
<ul class="nav nav-link-tabs mb-4">
  <li class="{{ $view === 'photos.index' ? 'active' : '' }}">
    <a href="{{ action('Photos@index') }}">{{ trans('photos.new') }}</a>
  </li>
  <li class="{{ $view === 'photos.tags' ? 'active' : '' }}">
    <a href="{{ action('Photos@tags') }}">{{ trans('photos.tags') }}</a>
  </li>
  <li class="{{ $view === 'photos.map' ? 'active' : '' }}">
    <a href="{{ action('Photos@map') }}">{{ trans('photos.map') }}</a>
  </li>
</ul>
@endsection
