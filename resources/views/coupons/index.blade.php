@extends('base')

@section('content')
<h1>{{ trans('coupons.index') }}</h1>
@ru
  <p>Простые способы сэкономить на услугах нижеприведенных сервисов.</p>
@en
  <p>Easy ways to get discounts for the services below.</p>
@endru

<div class="antialiased hanging-puntuation-first lg:text-lg">
  <h3 class="mt-6">{{ trans('coupons.hosting') }}</h3>
  <ul>
    <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'digitalocean']) }}">{{ trans('coupons.digitalocean') }}</a></li>
    <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'firstvds']) }}">{{ trans('coupons.firstvds') }}</a></li>
    @ru
      <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'timeweb']) }}">{{ trans('coupons.timeweb') }}</a></li>
    @endru
  </ul>

  <h3 class="mt-6">{{ trans('coupons.accomodation') }}</h3>
  <ul>
    <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'airbnb']) }}">{{ trans('coupons.airbnb') }}</a></li>
    <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'booking']) }}">{{ trans('coupons.booking') }}</a></li>
  </ul>

  <h3 class="mt-6">{{ trans('coupons.simcards') }}</h3>
  <ul>
    <li class="mb-1"><a class="link" href="{{ path([App\Http\Controllers\Coupons::class, 'drimsim']) }}">{{ trans('coupons.drimsim') }}</a></li>
  </ul>
</div>
@endsection
