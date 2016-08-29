@extends('base', [
  'meta_title' => !empty($meta_title) ? $meta_title : trans($view),
])

@section('global_menu')
<li>
  <a class="{{ $self == 'Acp\Cities' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/cities">
    {{ trans('menu.cities') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Countries' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/countries">
    {{ trans('menu.countries') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Trips' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/trips">
    {{ trans('menu.trips') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Gigs' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/gigs">
    {{ trans('menu.gigs') }}
  </a>
</li>
<li>
  <a class="{{ $self == 'Acp\Artists' ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/artists">
    {{ trans('menu.artists') }}
  </a>
</li>
<li class="dropdown">
  <a class="dropdown-toggle {{ in_array($self, ['Acp\Clients', 'Acp\Domains', 'Acp\Servers', 'Acp\Pages']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">
    {{ trans('menu.hosting') }}
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a href="{{ $locale_uri }}/acp/clients">Клиенты</a></li>
    <li><a href="{{ $locale_uri }}/acp/domains">Домены</a></li>
    <li><a href="{{ $locale_uri }}/acp/servers">Серверы</a></li>
    <li><a href="{{ $locale_uri }}/acp/pages">Страницы</a></li>
    <li><a href="{{ $locale_uri }}/acp/users">Пользователи</a></li>
    <li><a href="{{ $locale_uri }}/acp/yandex/users">Пользователи Яндекс API</a></li>
  </ul>
</li>
<li>
  <a class="{{ starts_with($self, 'Acp\Dev') ? 'navbar-selected' : '' }}" href="{{ $locale_uri }}/acp/dev/templates">
    {{ trans('menu.dev') }}
  </a>
</li>
@endsection

@push('head')
<link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/acp.css') : '/build/css/acp.css' }}">
@endpush

@push('js')
<script src="{{ App::environment('production') ? elixir('js/acp.js') : '/build/js/acp.js' }}"></script>
@endpush
