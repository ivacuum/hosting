@if (!Request::pjax())
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
@endif
  <title>{{ $meta_title or config('cfg.sitename') }}</title>
@if (!Request::pjax())
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="{{ $meta_keywords or '' }}">
  <meta name="description" content="{{ $meta_description or '' }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-pjax-version" content="1">
  <link rel="icon" sizes="256x256" href="/apple-touch-icon.png">
  <link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/vendor.css') : '/build/css/vendor.css' }}">
  <link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/app.css') : '/build/css/app.css' }}">
  @yield('head')
</head>
<body>
<div class="wrap-content">
  <div class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><i class="fa fa-home"></i></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          @section('global_menu')
            <li><a class="{{ $self == 'Life' ? 'navbar-selected' : '' }}" href="/life">Заметки</a></li>
            <li><a class="{{ $self == 'ParserVk' ? 'navbar-selected' : '' }}" href="/parser/vk">Парсер ВК</a></li>
          @show
        </ul>
        @if (Auth::check())
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::user()->isAdmin())
              <li>
                <a href="/acp/domains">
                  <i class="fa fa-dashboard"></i>
                </a>
              </li>
            @endif
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->email }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/auth/logout">Выход</a></li>
              </ul>
            </li>
          </ul>
        @else
          <form class="navbar-form navbar-right">
            <a class="btn btn-default" href="/auth/login">Вход</a>
          </form>
        @endif
      </div>
    </div>
  </div>
  <div class="container">
@section('breadcrumbs')
@include('tpl.breadcrumbs', ['breadcrumbs' => isset($breadcrumbs) ? $breadcrumbs : Breadcrumbs::get()])
@show

@if (Session::has('message'))
  <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div id="pjax_container">
@endif
@yield('content_header')
@yield('content')
@yield('content_footer')
@if (!Request::pjax())
</div>

    <div class="wrap-push"></div>
  </div>
</div>
<footer>
  <div class="container">
    @section('footer')
      <ul class="list-inline">
        <li>&copy; {{ date('Y') }} vacuum</li>
        <li>&middot;</li>
        <li><a href="mailto:{{ config('email.support') }}" class="link">Обратная связь</a></li>
      </ul>
    @show
  </div>
</footer>
<script src="{{ App::environment('production') ? elixir('js/vendor.js') : '/build/js/vendor.js' }}"></script>
<script src="{{ App::environment('production') ? elixir('js/app.js') : '/build/js/app.js' }}"></script>
@yield('js')
</body>
</html>
@endif