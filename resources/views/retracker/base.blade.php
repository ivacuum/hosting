@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
  'noLanguageSelector' => $locale === 'ru',
  'contentContainerClasses' => 'antialiased hanging-puntuation-first lg:text-lg',
])

@section('bottom-tabbar')
@endsection

@section('global_menu')
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'index']),
  'isActive' => $view === 'retracker.index',
])
  {{ trans('retracker.index') }}
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'usage']),
  'isActive' => $view === 'retracker.usage',
])
  {{ trans('retracker.usage') }}
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'dev']),
  'isActive' => $view === 'retracker.dev',
])
  {{ trans('retracker.dev') }}
@endcomponent
@endsection

@section('footer_container')
@endsection
