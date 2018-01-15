@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $meta_title ?? '' }}" property="og:title">
<meta content="{{ canonical() }}" property="og:url">
<meta content="{{ $meta_image ?? '' }}" property="og:image">
<meta content="{{ $meta_description ?? '' }}" property="og:description">
@endpush

@section('brand')
{{--<a class="navbar-brand" href="{{ path('UserTravelTrips@index', $traveler->login) }}">{{ '@'.$traveler->login }}<br>@ru путешествует @en travels @endru</a>--}}
@endsection

@section('global_menu')
<li class="nav-item {{ starts_with($self, 'UserTravel') ? 'active' : '' }}">
  <a class="nav-link" href="{{ path('UserTravelTrips@index', $traveler->login) }}">
    {{ trans('menu.life') }}
  </a>
</li>
@endsection

@section('content_header')
<div class="life-text js-shortcuts-items">
@endsection

@section('content_footer')
</div>
@endsection
