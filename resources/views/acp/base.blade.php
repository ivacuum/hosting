@extends('base', [
  'meta_title' => !empty($meta_title) ? $meta_title : trans($view),
])

@section('bottom-tabbar')
@endsection

@section('header-navbar')
<div class="navbar navbar-default {{ Auth::user()->theme === App\User::THEME_DARK ? 'navbar-inverse' : '' }}">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle {{ in_array($self, ['Acp\Cities', 'Acp\Countries', 'Acp\Trips', 'Acp\Gigs', 'Acp\Artists', 'Acp\Tags', 'Acp\Photos']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
            {{ trans('menu.life') }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ $locale_uri }}/acp/cities">
                {{ trans('acp.cities.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/countries">
                {{ trans('acp.countries.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/trips">
                {{ trans('acp.trips.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/gigs">
                {{ trans('acp.gigs.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/artists">
                {{ trans('acp.artists.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/tags">
                {{ trans('acp.tags.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/photos">
                {{ trans('acp.photos.index') }}
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle {{ in_array($self, ['Acp\Clients', 'Acp\Domains', 'Acp\Servers', 'Acp\YandexUsers']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
            {{ trans('menu.hosting') }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ $locale_uri }}/acp/clients">
                {{ trans('acp.clients.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/domains">
                {{ trans('acp.domains.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/servers">
                {{ trans('acp.servers.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/yandex-users">
                {{ trans('acp.yandex-users.index') }}
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle {{ in_array($self, ['Acp\Comments', 'Acp\Torrents', 'Acp\Files', 'Acp\News', 'Acp\Images']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
            {{ trans('menu.resources') }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ $locale_uri }}/acp/comments">
                {{ trans('acp.comments.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/files">
                {{ trans('acp.files.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/news">
                {{ trans('acp.news.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/images">
                {{ trans('acp.images.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/torrents">
                {{ trans('acp.torrents.index') }}
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle {{ in_array($self, ['Acp\Metrics', 'Acp\Users', 'Acp\ExternalIdentities', 'Acp\Pages', 'Acp\Notifications']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
            {{ trans('menu.site') }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ $locale_uri }}/acp/metrics">
                {{ trans('acp.metrics.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/users">
                {{ trans('acp.users.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/external-identities">
                {{ trans('acp.external-identities.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/notifications">
                {{ trans('acp.notifications.index') }}
              </a>
            </li>
            <li>
              <a href="{{ $locale_uri }}/acp/pages">
                {{ trans('acp.pages.index') }}
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a class="{{ starts_with($self, 'Acp\Dev') ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/dev/templates">
            {{ trans('acp.dev.index') }}
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @include('tpl.header-navbar-user')
      </ul>
    </div>
  </div>
</div>
@endsection

@section('counters')
@endsection
