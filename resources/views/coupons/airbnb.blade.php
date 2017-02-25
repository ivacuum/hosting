@extends('base')

@section('content')
<h1 class="mt-0">{{ $meta_title }}</h1>
<div class="row">
  <div class="col-md-6">
    @ru
      <p>Вы легко можете получить скидку около 10 евро на ваши следующие бронирования на <a class="link" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">airbnb.ru</a> с помощью купонов ниже. Также я привожу информацию где удалось успешно воспользоваться данными купонами. Коды <span class="font-bold">работают для уже зарегистрированных пользователей</span>.</p>
    @en
      <p>You could easily get €10 off your booking cost on <a class="link" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">airbnb.com</a> just by using coupons below. I also provide the info where I successfully applied these coupons. It <span class="font-bold">works for already registered users</span>.</p>
    @endlang
  </div>
</div>
<div class="flex-table flex-table-bordered">
  <div class="flex-row flex-row-header">
    <div class="flex-cell">@ru Купон @en Coupon Code @endlang</div>
    <div class="flex-cell">@ru Где проверен @en Successfully used in @endlang</div>
  </div>
  <div class="flex-row-group flex-row-striped">
    <div class="flex-row">
      <div class="flex-cell">ALSACE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/hamburg.2016">Гамбург</a>
        @en
          <a class="link" href="/en/life/hamburg.2016">Hamburg</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">AMSTERDAM2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ANDALOUSIE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/amsterdam.2016">Амстердам</a>
        @en
          <a class="link" href="/en/life/amsterdam.2016">Amsterdam</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BALI2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/bali.2016">Бали</a>
        @en
          <a class="link" href="/en/life/bali.2016">Bali</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BARCELONE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BELGIQUE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BERLIN2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/berlin.2016">Берлин</a>
        @en
          <a class="link" href="/en/life/berlin.2016">Berlin</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BOURGOGNE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BRUXELLES2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">BUDAPEST2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">COPENHAGUE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">CROATIE2015</div>
      <div class="flex-cell">
        @ru
          Будапешт
        @en
          Budapest
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">DUBLIN2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ECOSSE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/cologne.2016">Кельн</a>
        @en
          <a class="link" href="/en/life/cologne.2016">Cologne</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ESPAGNE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">FLORENCE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">IRLANDE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ISRAEL2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ISTANBUL2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">LISBONNE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">LONDRES2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">NEWYORK2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MADRID2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MALTE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MAROC2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MARSEILLE2016</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MIAMI2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MILAN2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MONTREAL2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">MOSCOU2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/msk.2016.06">Москва</a>
        @en
          <a class="link" href="/en/life/msk.2016.06">Moscow</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">NORVEGE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/krasnodar.2016">Краснодар</a>
        @en
          <a class="link" href="/en/life/krasnodar.2016">Krasnodar</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">NYC2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">NEWYORK2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">POLOGNE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/spb.2016.03">Санкт-Петербург</a>
        @en
          <a class="link" href="/en/life.spb.2016.03">Saint Petersburg</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">PORTUGAL2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">PRAGUE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/prague.2016">Прага</a>
        @en
          <a class="link" href="/en/life/prague.2016">Prague</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">ROME2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">SARDAIGNE2015</div>
      <div class="flex-cell">
        @ru
          <a class="link" href="/life/wiesbaden.2016">Висбаден</a>
        @en
          <a class="link" href="/en/life/wiesbaden.2016">Wiesbaden</a>
        @endlang
      </div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">SICILE2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">STOCKHOLM2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">SF2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">SANFRANCISCO2015</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row">
      <div class="flex-cell">VIENNE2015</div>
      <div class="flex-cell"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    @ru
      <h2>Новый пользователь Airbnb?</h2>
      <p>Тогда вы можете рассчитывать на еще большую скидку на вашу первую поездку.</p>
      <a class="btn btn-primary" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">Получить скидку на 1500 ₽</a>
      <span class="help-block">После клика вы будете перемещены на сайт airbnb.ru</span>
    @en
      <h2>New Airbnb user?</h2>
      <p>Then you can get even bigger discount for your first trip.</p>
      <a class="btn btn-primary" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">Get $25 coupon</a>
      <span class="help-block">After a click you will be redirected to airbnb.com</span>
    @endlang
  </div>
</div>
@endsection
