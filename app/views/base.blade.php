<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>{{ $meta_title or 'Title' }} &middot; {{ Config::get('cfg.sitename') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="{{ $meta_keywords or '' }}">
  <meta name="description" content="{{ $meta_description or '' }}">
  @section('head')
    <link rel="stylesheet" href="/css/app.min.css">
  @show
</head>
<body>
<div class="wrap-content">
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">{{ Config::get('cfg.sitename') }}</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          @section('global_menu')
          <li><a href="{{ route('acp.clients.index') }}">Клиенты</a></li>
          <li><a href="{{ route('acp.domains.index') }}">Домены</a></li>
          @show
        </ul>
        @if (Auth::check())
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->email }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                {{--
                <li><a href="/">Личный кабинет</a></li>
                <li class="divider"></li>
                --}}
                <li><a href="{{ route('logout') }}">Выход</a></li>
              </ul>
            </li>
          </ul>
        @else
          <form class="navbar-form navbar-right">
            <a class="btn btn-default" href="{{ route('login') }}">Вход</a>
          </form>
        @endif
      </div>
    </div>
  </div>
  <div class="container">
    {{--
    {block "breadcrumbs"}
      <ul class="breadcrumb">
        <li><a href="{$U_INDEX}">{'INDEX_PAGE'|i18n}</a></li>
        {foreach $breadcrumbs|default:[] as $row}
          {if not $row@last}
            <li><span class="divider">&rarr;</span><a href="{$row.URL}">{$row.TEXT}</a></li>
          {else}
            <li class="active"><span class="divider">&rarr;</span>{$row.TEXT}</li>
          {/if}
        {/foreach}
      </ul>
    {/block}
    --}}

@if (Session::has('message'))
  <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@yield('content_header')
@yield('content')
@yield('content_footer')

    <div class="wrap-push"></div>
  </div>
</div>
<footer>
  <div class="container">
    <ul class="list-inline">
      <li class="text-muted">&copy; {{ date('Y') }} vacuum</li>
      <li class="text-muted">&middot;</li>
      <li><a href="mailto:{{ Config::get('email.support') }}">Обратная связь</a></li>
	  <li><a href="{{ route('parser.vk') }}">Парсер ВК</a></li>
    </ul>
  </div>
</footer>
@section('js')
<script src="/js/app.min.js"></script>
@show
</body>
</html>