@extends('base')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">{{ $metaTitle }}</h1>
<div class="max-w-[600px]">
  @ru
    <p>Получите скидку около 1000 рублей на ваше следующее бронирование на <a class="link" href="{{ App\Domain\Config::BookingLink }}">booking.com</a> с помощью кнопки ниже.</p>
    <a class="btn btn-primary" href="{{ App\Domain\Config::BookingLink }}">Получить скидку 1000 ₽</a>
    <div class="form-help">После клика вы будете перемещены на сайт booking.com</div>
  @en
    <p>Cut €15 off your booking cost on <a class="link" href="{{ App\Domain\Config::BookingLink }}">booking.com</a> just by clicking button below.</p>
    <a class="btn btn-primary" href="{{ App\Domain\Config::BookingLink }}">Get €15 discount</a>
    <div class="form-help">After a click you will be redirected to booking.com</div>
  @endru
</div>
@endsection
