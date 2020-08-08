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
  {{ __('Ретрекер') }}
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'usage']),
  'isActive' => $view === 'retracker.usage',
])
  {{ __('Как использовать') }}
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'dev']),
  'isActive' => $view === 'retracker.dev',
])
  {{ __('О разработке') }}
@endcomponent
@endsection

@section('footer_container')
@endsection
