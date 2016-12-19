@extends('base', [
  'meta_title' => !empty($meta_title) ? $meta_title : trans($view),
])

@section('brand')
@endsection

@section('global_menu')
<li>
  <a class="{{ $self == 'Acp\Cities' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/cities">
    {{ trans('acp.cities.index') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Countries' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/countries">
    {{ trans('acp.countries.index') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Trips' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/trips">
    {{ trans('acp.trips.index') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Gigs' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/gigs">
    {{ trans('acp.gigs.index') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Artists' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/artists">
    {{ trans('acp.artists.index') }}
  </a>
</li>
<li class="dropdown">
  <a class="dropdown-toggle {{ in_array($self, ['Acp\Clients', 'Acp\Domains', 'Acp\Servers', 'Acp\Pages']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
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
      <a href="{{ $locale_uri }}/acp/pages">
        {{ trans('acp.pages.index') }}
      </a>
    </li>
    <li>
      <a href="{{ $locale_uri }}/acp/users">
        {{ trans('acp.users.index') }}
      </a>
    </li>
    <li>
      <a href="{{ $locale_uri }}/acp/yandex/users">
        {{ trans('acp.yandex.users.index') }}
      </a>
    </li>
  </ul>
</li>
<li>
  <a class="{{ starts_with($self, 'Acp\Dev') ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/dev/templates">
    {{ trans('acp.dev.index') }}
  </a>
</li>
@endsection

@section('counters')
@endsection

@push('head')
<link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/acp.css') : '/build/css/acp.css' }}">
@endpush

@push('js')
<script src="{{ App::environment('production') ? elixir('js/acp.js') : '/build/js/acp.js' }}"></script>
@endpush
