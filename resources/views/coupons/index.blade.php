@extends('base')

@section('content')
<h1 class="mt-0">{{ trans('coupons.index') }}</h1>
@ru
  <p>Простые способы сэкономить на услугах нижеприведенных сервисов.</p>
@en
  <p>Easy ways to get discounts for the services below.</p>
@endru

<div class="life-text">
  <h3>{{ trans('coupons.hosting') }}</h3>
  <ul class="list-styled">
    <li class="mb-1"><a class="link" href="{{ path('Coupons@digitalocean') }}">{{ trans('coupons.digitalocean') }}</a></li>
    <li class="mb-1"><a class="link" href="{{ path('Coupons@firstvds') }}">{{ trans('coupons.firstvds') }}</a></li>
    <li class="mb-1"><a class="link" href="{{ path('Coupons@timeweb') }}">{{ trans('coupons.timeweb') }}</a></li>
  </ul>

  <h3>{{ trans('coupons.accomodation') }}</h3>
  <ul class="list-styled">
    <li class="mb-1"><a class="link" href="{{ path('Coupons@airbnb') }}">{{ trans('coupons.airbnb') }}</a></li>
    <li class="mb-1"><a class="link" href="{{ path('Coupons@booking') }}">{{ trans('coupons.booking') }}</a></li>
  </ul>
</div>
@endsection
