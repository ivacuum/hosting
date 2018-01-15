@extends('base', [
  'body_classes' => '',
  'navbar_classes' => '',
])

@section('bottom-tabbar')
@endsection

@section('brand')
@endsection

@section('global_menu')
<li class="nav-item dropdown dropdown-hover {{ in_array($self, ['Acp\Cities', 'Acp\Countries', 'Acp\Trips', 'Acp\Gigs', 'Acp\Artists', 'Acp\Tags', 'Acp\Photos']) ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
    {{ trans('menu.life') }}
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/cities">{{ trans('acp.cities.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/countries">{{ trans('acp.countries.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/trips">{{ trans('acp.trips.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/gigs">{{ trans('acp.gigs.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/artists">{{ trans('acp.artists.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/tags">{{ trans('acp.tags.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/photos">{{ trans('acp.photos.index') }}</a>
  </div>
</li>
<li class="nav-item dropdown dropdown-hover {{ in_array($self, ['Acp\Clients', 'Acp\Domains', 'Acp\Servers', 'Acp\YandexUsers']) ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
    {{ trans('menu.hosting') }}
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/clients">{{ trans('acp.clients.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/domains">{{ trans('acp.domains.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/servers">{{ trans('acp.servers.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/yandex-users">{{ trans('acp.yandex-users.index') }}</a>
  </div>
</li>
<li class="nav-item dropdown dropdown-hover {{ in_array($self, ['Acp\Comments', 'Acp\Torrents', 'Acp\Files', 'Acp\News', 'Acp\Images']) ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
    {{ trans('menu.resources') }}
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/chat-messages">{{ trans('acp.chat-messages.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/comments">{{ trans('acp.comments.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/dcpp-hubs">{{ trans('acp.dcpp-hubs.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/files">{{ trans('acp.files.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/news">{{ trans('acp.news.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/images">{{ trans('acp.images.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/torrents">{{ trans('acp.torrents.index') }}</a>
  </div>
</li>
<li class="nav-item dropdown dropdown-hover {{ in_array($self, ['Acp\Metrics', 'Acp\Users', 'Acp\ExternalIdentities', 'Acp\Pages', 'Acp\Notifications']) ? 'active' : '' }}">
  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
    {{ trans('menu.site') }}
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/metrics">{{ trans('acp.metrics.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/users">{{ trans('acp.users.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/external-identities">{{ trans('acp.external-identities.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/notifications">{{ trans('acp.notifications.index') }}</a>
    <a class="dropdown-item" href="{{ $locale_uri }}/acp/pages">{{ trans('acp.pages.index') }}</a>
  </div>
</li>
<li class="nav-item {{ starts_with($self, 'Acp\Dev') ? 'active' : '' }}">
  <a class="nav-link" href="{{ $locale_uri }}/acp/dev/templates">
    {{ trans('acp.dev.index') }}
  </a>
</li>
@endsection

@section('counters')
@endsection
