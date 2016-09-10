@if (!Request::pjax())
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
@endif
  <title>{{ $meta_title or config('cfg.sitename') }}</title>
@if (!Request::pjax())
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="{{ $meta_keywords or '' }}">
  <meta name="description" content="{{ $meta_description or '' }}">
  <meta http-equiv="x-pjax-version" content="1">
  <link rel="icon" sizes="256x256" href="/apple-touch-icon.png">
  <link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/vendor.css') : '/build/css/vendor.css' }}">
  <link rel="stylesheet" href="{{ App::environment('production') ? elixir('css/app.css') : '/build/css/app.css' }}">
  @stack('head')
</head>
<body>
<div class="wrap-content">
  <div class="navbar navbar-default {{ App::environment('local') ? 'navbar-inverse' : '' }}">
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
          @section('global_menu')
            <li>
              <a class="{{ $self == 'Home' ? 'navbar-selected' : '' }}" href="{{ action('Home@index') }}">
                {{ trans('menu.home') }}
              </a>
            </li>
            <li>
              <a class="{{ $self == 'Life' ? 'navbar-selected' : '' }}" href="{{ action('Life@index') }}">
                {{ trans('menu.life') }}
              </a>
            </li>
            @ru
              <li>
                <a class="{{ $self == 'ParserVk' ? 'navbar-selected' : '' }}" href="{{ action('ParserVk@index') }}">
                  {{ trans('menu.parser_vk') }}
                </a>
              </li>
            @endlang
            @if (App::environment('local'))
              <li>
                <a class="{{ $self == 'Docs' ? 'navbar-selected' : '' }}" href="{{ action('Docs@index') }}">
                  {{ trans('menu.docs') }}
                </a>
              </li>
            @endif
          @show
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{ trans('menu.language') }}
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ url("en/{$request_uri}") }}" lang="en">English</a></li>
              <li><a href="{{ url($request_uri) }}" lang="ru">Русский</a></li>
            </ul>
          </li>
          @if (Auth::check())
              @if (Auth::user()->isAdmin())
                <li>
                  <a href="{{ App::environment('local') ? "{$locale_uri}/acp/dev/templates" : "{$locale_uri}/acp/trips" }}">
                    @svg (dashboard)
                  </a>
                </li>
              @endif
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->email }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ action('Auth@logout') }}">
                      {{ trans('menu.logout') }}
                    </a>
                  </li>
                </ul>
              </li>
          @else
            {{--
            <form class="navbar-form navbar-right">
              <a class="btn btn-default" href="/auth/login">Вход</a>
            </form>
            --}}
          @endif
        </ul>
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
        <li>
          <a class="link" href="mailto:{{ config('email.support') }}">
            {{ trans('menu.feedback') }}
          </a>
        </li>
        <li>
          <a class="link" href="https://vk.com/ivacuum">
            {{ trans('menu.vk') }}
          </a>
        </li>
        <li>
          <a class="link" href="https://www.instagram.com/ivacuum">
            {{ trans('menu.instagram') }}
          </a>
        </li>
      </ul>
    @show
  </div>
</footer>
<script>
window.AppOptions = <?php echo json_encode([
  'csrfToken' => csrf_token(),
  'locale' => $locale,
]); ?>
</script>
<script src="{{ App::environment('production') ? elixir('js/vendor.js') : '/build/js/vendor.js' }}"></script>
<script src="{{ App::environment('production') ? elixir('js/app.js') : '/build/js/app.js' }}"></script>
@stack('js')
@section('counters')
@include('tpl.counters')
@show
</body>
</html>
@endif
