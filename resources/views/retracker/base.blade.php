@extends('base', [
  'body_classes' => '',
  'navbar_classes' => '',
  'no_language_selector' => $locale === 'ru',
  'content_container_classes' => 'life-text',
])

@section('bottom-tabbar')
@endsection

@section('global_menu')
<li class="nav-item {{ $view === 'retracker.index' ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('Retracker@index') }}">
    {{ trans('retracker.index') }}
  </a>
</li>
<li class="nav-item {{ $view === 'retracker.usage' ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('Retracker@usage') }}">
    {{ trans('retracker.usage') }}
  </a>
</li>
<li class="nav-item {{ $view === 'retracker.dev' ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('Retracker@dev') }}">
    {{ trans('retracker.dev') }}
  </a>
</li>
@endsection

@section('footer_container')
@endsection
