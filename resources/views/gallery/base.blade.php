@extends('base')

@section('content_header')
@if (Auth::check())
  <ul class="nav nav-link-tabs mb-4">
    <li class="{{ $view === 'gallery.index' ? 'active' : '' }}">
      <a href="{{ path('Gallery@index') }}">{{ trans('gallery.my') }}</a>
    </li>
    <li class="{{ $view === 'gallery.upload' ? 'active' : '' }}">
      <a href="{{ path('Gallery@upload') }}">{{ trans('gallery.upload') }}</a>
    </li>
  </ul>
@endif
@endsection
