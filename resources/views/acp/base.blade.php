@extends('base')

@section('global_menu')
  <li>
    <a class="{{ $self == 'Acp\Clients' ? 'navbar-selected' : '' }}" href="/acp/clients">Клиенты</a>
  </li>
  <li>
    <a class="{{ $self == 'Acp\Domains' ? 'navbar-selected' : '' }}" href="/acp/domains">Домены</a>
  </li>
  <li>
    <a class="{{ $self == 'Acp\Servers' ? 'navbar-selected' : '' }}" href="/acp/servers">Серверы</a>
  </li>
  <li>
    <a class="{{ $self == 'Acp\Pages' ? 'navbar-selected' : '' }}" href="/acp/pages">Страницы</a>
  </li>
@stop