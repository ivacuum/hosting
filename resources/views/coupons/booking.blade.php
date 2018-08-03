@extends('base')

@section('content')
<h1>{{ $meta_title }}</h1>
<div class="mw-600">
  @ru
    <p>Получите скидку около 1000 рублей на ваше следующее бронирование на <a class="link" href="{{ config('cfg.booking_link') }}">booking.com</a> с помощью кнопки ниже.</p>
    <a class="btn btn-primary" href="{{ config('cfg.booking_link') }}">Получить скидку 1000 ₽</a>
    <div class="form-help">После клика вы будете перемещены на сайт booking.com</div>
  @en
    <p>Cut €15 off your booking cost on <a class="link" href="{{ config('cfg.booking_link') }}">booking.com</a> just by clicking button below.</p>
    <a class="btn btn-primary" href="{{ config('cfg.booking_link') }}">Get €15 discount</a>
    <div class="form-help">After a click you will be redirected to booking.com</div>
  @endru
</div>
@endsection
