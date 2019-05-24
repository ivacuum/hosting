@extends('life.gigs.base')

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <div class="mb-2">
        @include('tpl.gig-countdown', ['show_datetime' => '2019-07-29 19:00:00'])
      </div>
      <p>Новый тур группы Rammstein. Это будет уже шестнадцатое выступление по счету в России. Сетлист будет известен вместе с первым концертом в Гельзенкирхене 27 мая. Незадолго до этого (17 мая) был выпущен новый студийный альбом под названием Rammstein.</p>
      <p>Место проведения концерта: большая спортивная арена Лужники.</p>
      <p>
        Билеты в продаже с 8 ноября 10:00 по Москве.
        @if (!now()->gte('2018-11-08 10:00:00'))
          Цены стоит ожидать около 100 евро, а также сервисный сбор в размере 10%.
        @endif
      </p>
      <p>Ждем-с.</p>
      <p>
        <a class="btn btn-primary" href="http://tci.ru/rammstein2019/">Купить билет</a>
        <a class="btn btn-default" href="https://vk.com/rammstein_2019_msk">Группа ВК</a>
      </p>
    @endru
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.org/gigs/rammstein.2019.07.29.png">
    </div>
  </div>
</div>
@endsection
