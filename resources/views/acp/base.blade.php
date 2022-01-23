@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
])

@section('bottom-tabbar')
@endsection

@section('brand')
<div class="md:hidden">
  @parent
</div>
@endsection

@section('global_menu')
@component('tpl.menu-dropdown', [
  'isActive' => Str::of($routeUri)->is([
    'acp/cities*',
    'acp/countries*',
    'acp/trips*',
    'acp/gigs*',
    'acp/artists*',
    'acp/tags*',
    'acp/photos*',
  ]),
])
  @slot('title')
    @lang('Заметки')
  @endslot

  <x-dropdown-item href="/acp/cities">@lang('acp.cities.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/countries">@lang('acp.countries.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/trips">@lang('acp.trips.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/gigs">@lang('acp.gigs.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/artists">@lang('acp.artists.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/tags">@lang('acp.tags.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/photos">@lang('acp.photos.index')</x-dropdown-item>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => Str::of($routeUri)->is([
    'acp/clients*',
    'acp/domains*',
    'acp/servers*',
    'acp/yandex-users*',
  ]),
])
  @slot('title')
    @lang('Хостинг')
  @endslot

  <x-dropdown-item href="/acp/clients">@lang('acp.clients.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/domains">@lang('acp.domains.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/servers">@lang('acp.servers.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/yandex-users">@lang('acp.yandex-users.index')</x-dropdown-item>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => Str::of($routeUri)->is([
    'acp/chat-messages*',
    'acp/comments*',
    'acp/dcpp-hubs*',
    'acp/torrents*',
    'acp/files*',
    'acp/news*',
    'acp/images*',
  ]),
])
  @slot('title')
    @lang('Ресурсы')
  @endslot

  <x-dropdown-item href="/acp/chat-messages">@lang('acp.chat-messages.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/comments">@lang('acp.comments.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/dcpp-hubs">@lang('acp.dcpp-hubs.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/files">@lang('acp.files.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/news">@lang('acp.news.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/images">@lang('acp.images.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/torrents">@lang('acp.torrents.index')</x-dropdown-item>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => Str::of($routeUri)->is([
    'acp/metrics*',
    'acp/issues*',
    'acp/users*',
    'acp/external-identities*',
    'acp/notifications*',
  ]),
])
  @slot('title')
    @lang('Сайт')
  @endslot

  <x-dropdown-item href="/acp/metrics">@lang('acp.metrics.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/issues">@lang('acp.issues.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/users">@lang('acp.users.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/external-identities">@lang('acp.external-identities.index')</x-dropdown-item>
  <x-dropdown-item href="/acp/notifications">@lang('acp.notifications.index')</x-dropdown-item>
@endcomponent
@component('tpl.menu-item', [
  'href' => to('acp/dev/templates'),
  'isActive' => Str::of($routeUri)->is(['acp/dev', 'acp/dev/*']),
])
  @lang('acp.dev.index')
@endcomponent
@endsection

@section('counters')
@endsection
