@extends('base')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">@lang('coupons.index')</h1>
@ru
  <p>Простые способы сэкономить на услугах нижеприведенных сервисов.</p>
@en
  <p>Easy ways to get discounts for the services below.</p>
@endru

<div class="antialiased hanging-punctuation-first lg:text-lg">
  <h3 class="font-medium text-2xl mt-8 mb-1">@lang('coupons.hosting')</h3>
  <ul>
    <li><a class="link" href="@lng/promocodes-coupons/digitalocean">@lang('coupons.digitalocean')</a></li>
    <li><a class="link" href="@lng/promocodes-coupons/firstvds">@lang('coupons.firstvds')</a></li>
    @ru
      <li><a class="link" href="@lng/promocodes-coupons/timeweb">@lang('coupons.timeweb')</a></li>
    @endru
  </ul>

  <h3 class="font-medium text-2xl mt-8 mb-1">@lang('coupons.accomodation')</h3>
  <ul>
    <li><a class="link" href="@lng/promocodes-coupons/airbnb">@lang('coupons.airbnb')</a></li>
    <li><a class="link" href="@lng/promocodes-coupons/booking">@lang('coupons.booking')</a></li>
  </ul>

  <h3 class="font-medium text-2xl mt-8 mb-1">@lang('coupons.simcards')</h3>
  <ul>
    <li><a class="link" href="@lng/promocodes-coupons/drimsim">@lang('coupons.drimsim')</a></li>
  </ul>
</div>
@endsection
