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
  @lang('Ретрекер')
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'usage']),
  'isActive' => $view === 'retracker.usage',
])
  @lang('Как использовать')
@endcomponent
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\Retracker::class, 'dev']),
  'isActive' => $view === 'retracker.dev',
])
  @lang('О разработке')
@endcomponent
@endsection

@section('footer_container')
@endsection
