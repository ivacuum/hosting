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

  <a class="dropdown-item" href="@lng/acp/cities">@lang('acp.cities.index')</a>
  <a class="dropdown-item" href="@lng/acp/countries">@lang('acp.countries.index')</a>
  <a class="dropdown-item" href="@lng/acp/trips">@lang('acp.trips.index')</a>
  <a class="dropdown-item" href="@lng/acp/gigs">@lang('acp.gigs.index')</a>
  <a class="dropdown-item" href="@lng/acp/artists">@lang('acp.artists.index')</a>
  <a class="dropdown-item" href="@lng/acp/tags">@lang('acp.tags.index')</a>
  <a class="dropdown-item" href="@lng/acp/photos">@lang('acp.photos.index')</a>
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

  <a class="dropdown-item" href="@lng/acp/clients">@lang('acp.clients.index')</a>
  <a class="dropdown-item" href="@lng/acp/domains">@lang('acp.domains.index')</a>
  <a class="dropdown-item" href="@lng/acp/servers">@lang('acp.servers.index')</a>
  <a class="dropdown-item" href="@lng/acp/yandex-users">@lang('acp.yandex-users.index')</a>
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

  <a class="dropdown-item" href="@lng/acp/chat-messages">@lang('acp.chat-messages.index')</a>
  <a class="dropdown-item" href="@lng/acp/comments">@lang('acp.comments.index')</a>
  <a class="dropdown-item" href="@lng/acp/dcpp-hubs">@lang('acp.dcpp-hubs.index')</a>
  <a class="dropdown-item" href="@lng/acp/files">@lang('acp.files.index')</a>
  <a class="dropdown-item" href="@lng/acp/news">@lang('acp.news.index')</a>
  <a class="dropdown-item" href="@lng/acp/images">@lang('acp.images.index')</a>
  <a class="dropdown-item" href="@lng/acp/torrents">@lang('acp.torrents.index')</a>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => Str::of($routeUri)->is([
    'acp/kanjis*',
    'acp/radicals*',
    'acp/vocabularies*',
  ]),
])
  @slot('title')
    日本語
  @endslot

  <a class="dropdown-item" href="@lng/acp/kanjis">@lang('acp.kanjis.index')</a>
  <a class="dropdown-item" href="@lng/acp/radicals">@lang('acp.radicals.index')</a>
  <a class="dropdown-item" href="@lng/acp/vocabularies">@lang('acp.vocabularies.index')</a>
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

  <a class="dropdown-item" href="@lng/acp/metrics">@lang('acp.metrics.index')</a>
  <a class="dropdown-item" href="@lng/acp/issues">@lang('acp.issues.index')</a>
  <a class="dropdown-item" href="@lng/acp/users">@lang('acp.users.index')</a>
  <a class="dropdown-item" href="@lng/acp/external-identities">@lang('acp.external-identities.index')</a>
  <a class="dropdown-item" href="@lng/acp/notifications">@lang('acp.notifications.index')</a>
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
