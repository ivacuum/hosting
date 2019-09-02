@extends('base', [
  'body_classes' => '',
  'navbar_classes' => '',
  'no_language_selector' => $locale === 'ru',
  'content_container_classes' => 'antialiased hanging-puntuation-first lg:text-lg',
])

@section('bottom-tabbar')
@endsection

@section('global_menu')
@component('tpl.menu-item', ['href' => path('Retracker@index'), 'isActive' => $view === 'retracker.index'])
  {{ trans('retracker.index') }}
@endcomponent
@component('tpl.menu-item', ['href' => path('Retracker@usage'), 'isActive' => $view === 'retracker.usage'])
  {{ trans('retracker.usage') }}
@endcomponent
@component('tpl.menu-item', ['href' => path('Retracker@dev'), 'isActive' => $view === 'retracker.dev'])
  {{ trans('retracker.dev') }}
@endcomponent
@endsection

@section('footer_container')
@endsection
