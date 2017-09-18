@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $meta_title ?? '' }}" property="og:title">
<meta content="{{ Request::url() }}" property="og:url">
<meta content="{{ $meta_image ?? '' }}" property="og:image">
<meta content="{{ $meta_description ?? '' }}" property="og:description">
@endpush

@section('header-navbar')
<div class="navbar navbar-default hidden-xs {{ Auth::check() && Auth::user()->theme === App\User::THEME_DARK ? 'navbar-inverse' : '' }}">
  <div class="container">
    <div class="navbar-collapse">
      {{--
      @section('brand')
        <a class="navbar-brand" href="{{ path('UserTravelTrips@index', $traveler->login) }}">{{ '@'.$traveler->login }}<br>@ru путешествует @en travels @endru</a>
      @show
      --}}
      <ul class="nav navbar-nav">
        @section('global_menu')
          <li>
            <a class="{{ starts_with($self, 'UserTravel') ? 'navbar-selected' : '' }}" href="{{ path('UserTravelTrips@index', $traveler->login) }}">
              {{ trans('menu.life') }}
            </a>
          </li>
        @show
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @section('header_user')
          @if (Auth::check())
            @include('tpl.header-navbar-user')
          @else
            <li>
              <a href="{{ path('Auth\SignIn@index') }}">{{ trans('auth.signin') }}</a>
            </li>
          @endif
        @show
      </ul>
    </div>
  </div>
</div>
@endsection

@section('content_header')
<div class="life-text js-shortcuts-items">
@endsection

@section('content_footer')
</div>
@endsection
