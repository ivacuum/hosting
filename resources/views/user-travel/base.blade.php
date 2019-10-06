@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $metaTitle ?? '' }}" property="og:title">
<meta content="{{ canonical() }}" property="og:url">
<meta content="{{ $metaImage ?? '' }}" property="og:image">
<meta content="{{ $metaDescription ?? '' }}" property="og:description">
@endpush

@section('brand')
{{--<a class="site-brand" href="{{ path([App\Http\Controllers\UserTravelTrips::class, 'index'], $traveler->login) }}">{{ '@'.$traveler->login }}<br>@ru путешествует @en travels @endru</a>--}}
@endsection

@section('global_menu')
@component('tpl.menu-item', [
  'href' => path([App\Http\Controllers\UserTravelTrips::class, 'index'], $traveler->login),
  'isActive' => Str::startsWith($self, 'UserTravel'),
])
  {{ trans('menu.life') }}
@endcomponent
@endsection

@section('content_header')
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@endsection
