@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
  'noLanguageSelector' => $locale === 'ru',
  'contentContainerClasses' => 'antialiased hanging-punctuation-first lg:text-lg',
])

@section('bottom-tabbar')
@endsection

@section('global_menu')
@component('tpl.menu-item', [
  'href' => to('retracker'),
  'isActive' => $routeUri === 'retracker',
])
  @lang('Ретрекер')
@endcomponent
@component('tpl.menu-item', [
  'href' => to('retracker/usage'),
  'isActive' => $routeUri === 'retracker/usage',
])
  @lang('Как использовать')
@endcomponent
@component('tpl.menu-item', [
  'href' => to('retracker/dev'),
  'isActive' => $routeUri === 'retracker/dev',
])
  @lang('О разработке')
@endcomponent
@endsection

@section('footer_container')
@endsection
