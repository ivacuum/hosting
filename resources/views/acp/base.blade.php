@extends('base', [
  'meta_title' => !empty($meta_title) ? $meta_title : trans("meta_title.{$view}"),
])

@section('global_menu')
  <li><a class="{{ $self == 'Acp\Cities' ? 'navbar-selected' : '' }}" href="/acp/cities">Города</a></li>
  <li><a class="{{ $self == 'Acp\Countries' ? 'navbar-selected' : '' }}" href="/acp/countries">Страны</a></li>
  <li><a class="{{ $self == 'Acp\Trips' ? 'navbar-selected' : '' }}" href="/acp/trips">Поездки</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle {{ in_array($self, ['Acp\Clients', 'Acp\Domains', 'Acp\Servers', 'Acp\Pages']) ? 'navbar-selected' : '' }}" href="#" data-toggle="dropdown">Хостинг <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="/acp/clients">Клиенты</a></li>
      <li><a href="/acp/domains">Домены</a></li>
      <li><a href="/acp/servers">Серверы</a></li>
      <li><a href="/acp/pages">Страницы</a></li>
    </ul>
  </li>
@endsection

@push('head')
  <link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/acp.css') : '/build/css/acp.css' }}">
@endpush

@push('js')
  <script src="{{ App::environment('production') ? elixir('js/acp.js') : '/build/js/acp.js' }}"></script>
@endpush
