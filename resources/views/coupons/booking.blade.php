@extends('base')

@section('content')
<h1 class="mt-0">{{ $meta_title }}</h1>
<div class="row">
  <div class="col-md-6">
    @ru
      <p>Получите скидку около 1000 рублей на ваше следующее бронирование на <a class="link" href="{{ config('cfg.booking_link') }}">booking.com</a> с помощью кнопки ниже.</p>
      <a class="btn btn-primary" href="{{ config('cfg.booking_link') }}">Получить скидку 1000 ₽</a>
      <span class="help-block">После клика вы будете перемещены на сайт booking.com</span>
    @en
      <p>Cut €15 off your booking cost on <a class="link" href="{{ config('cfg.booking_link') }}">booking.com</a> just by clicking button below.</p>
      <a class="btn btn-primary" href="{{ config('cfg.booking_link') }}">Get €15 discount</a>
      <span class="help-block">After a click you will be redirected to booking.com</span>
    @endru
  </div>
</div>
@endsection
