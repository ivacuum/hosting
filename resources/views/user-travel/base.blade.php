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
@component('tpl.menu-item', ['href' => path('UserTravelTrips@index', $traveler->login), 'isActive' => Illuminate\Support\Str::startsWith($self, 'UserTravel')])
  {{ trans('menu.life') }}
@endcomponent
@endsection

@section('content_header')
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@endsection
