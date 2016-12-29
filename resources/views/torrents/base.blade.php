@extends('base')

@section('content_header')
<ul class="nav nav-link-tabs">
  <li class="{{ $view == 'torrents.index' ? 'active' : '' }}">
    <a href="{{ action('Torrents@index') }}">Новое</a>
  </li>
  @if (Auth::check())
    <li class="{{ $view == 'torrents.add' ? 'active' : '' }}">
      <a href="{{ action('Torrents@add') }}">{{ trans('torrents.add') }}</a>
    </li>
  @endif
  <li class="{{ $view == 'torrents.faq' ? 'active' : '' }}">
    <a href="{{ action('Torrents@faq') }}">Помощь</a>
  </li>
</ul>
@endsection
