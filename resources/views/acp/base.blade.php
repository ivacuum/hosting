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
  'isActive' => in_array($controller, [
    App\Http\Controllers\Acp\Cities::class,
    App\Http\Controllers\Acp\Countries::class,
    App\Http\Controllers\Acp\Trips::class,
    App\Http\Controllers\Acp\Gigs::class,
    App\Http\Controllers\Acp\Artists::class,
    App\Http\Controllers\Acp\Tags::class,
    App\Http\Controllers\Acp\Photos::class,
  ]),
])
  @slot('title')
    {{ trans('menu.life') }}
  @endslot

  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/cities">{{ trans('acp.cities.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/countries">{{ trans('acp.countries.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/trips">{{ trans('acp.trips.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/gigs">{{ trans('acp.gigs.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/artists">{{ trans('acp.artists.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/tags">{{ trans('acp.tags.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/photos">{{ trans('acp.photos.index') }}</a>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => in_array($controller, [
    App\Http\Controllers\Acp\Clients::class,
    App\Http\Controllers\Acp\Domains::class,
    App\Http\Controllers\Acp\Servers::class,
    App\Http\Controllers\Acp\YandexUsers::class,
  ]),
])
  @slot('title')
    {{ trans('menu.hosting') }}
  @endslot

  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/clients">{{ trans('acp.clients.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/domains">{{ trans('acp.domains.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/servers">{{ trans('acp.servers.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/yandex-users">{{ trans('acp.yandex-users.index') }}</a>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => in_array($controller, [
    App\Http\Controllers\Acp\ChatMessages::class,
    App\Http\Controllers\Acp\Comments::class,
    App\Http\Controllers\Acp\DcppHubs::class,
    App\Http\Controllers\Acp\Torrents::class,
    App\Http\Controllers\Acp\Files::class,
    App\Http\Controllers\Acp\News::class,
    App\Http\Controllers\Acp\Images::class,
  ])
])
  @slot('title')
    {{ trans('menu.resources') }}
  @endslot

  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/chat-messages">{{ trans('acp.chat-messages.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/comments">{{ trans('acp.comments.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/dcpp-hubs">{{ trans('acp.dcpp-hubs.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/files">{{ trans('acp.files.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/news">{{ trans('acp.news.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/images">{{ trans('acp.images.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/torrents">{{ trans('acp.torrents.index') }}</a>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => in_array($controller, [
    App\Http\Controllers\Acp\Kanjis::class,
    App\Http\Controllers\Acp\Radicals::class,
    App\Http\Controllers\Acp\Vocabularies::class,
  ])
])
  @slot('title')
    日本語
  @endslot

  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/kanjis">{{ trans('acp.kanjis.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/radicals">{{ trans('acp.radicals.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/vocabularies">{{ trans('acp.vocabularies.index') }}</a>
@endcomponent
@component('tpl.menu-dropdown', [
  'isActive' => in_array($controller, [
    App\Http\Controllers\Acp\Metrics::class,
    App\Http\Controllers\Acp\Issues::class,
    App\Http\Controllers\Acp\Users::class,
    App\Http\Controllers\Acp\ExternalIdentities::class,
    App\Http\Controllers\Acp\Notifications::class,
  ])
])
  @slot('title')
    {{ trans('menu.site') }}
  @endslot

  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/metrics">{{ trans('acp.metrics.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/issues">{{ trans('acp.issues.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/users">{{ trans('acp.users.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/external-identities">{{ trans('acp.external-identities.index') }}</a>
  <a class="dropdown-item-tw" href="{{ $localeUri }}/acp/notifications">{{ trans('acp.notifications.index') }}</a>
@endcomponent
@component('tpl.menu-item', [
  'href' => "{$localeUri}/acp/dev/templates",
  'isActive' => Str::startsWith($self, 'Acp\Dev'),
])
  {{ trans('acp.dev.index') }}
@endcomponent
@endsection

@section('counters')
@endsection
