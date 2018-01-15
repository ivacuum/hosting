@extends('base')

@section('content')
<h1>{{ $meta_title }}</h1>
<div class="row">
  <div class="col-md-6">
    @ru
      <p>Вы легко можете получить скидку около 10 евро на ваши следующие бронирования на <a class="link" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">airbnb.ru</a> с помощью купонов ниже. Также я привожу информацию где удалось успешно воспользоваться данными купонами. Коды <span class="font-weight-bold">работают для уже зарегистрированных пользователей</span>.</p>
    @en
      <p>You could easily get €10 off your booking cost on <a class="link" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">airbnb.com</a> just by using coupons below. I also provide the info where I successfully applied these coupons. It <span class="font-weight-bold">works for already registered users</span>.</p>
    @endru
  </div>
</div>
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>@ru Купон @en Coupon Code @endru</th>
      <th>@ru Где проверен @en Successfully used in @endru</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>ALSACE2015</td>
      <td>
        @ru
          <a class="link" href="/life/hamburg.2016">Гамбург</a>
        @en
          <a class="link" href="/en/life/hamburg.2016">Hamburg</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>AMSTERDAM2015</td>
      <td></td>
    </tr>
    <tr>
      <td>ANDALOUSIE2015</td>
      <td>
        @ru
          <a class="link" href="/life/amsterdam.2016">Амстердам</a>
        @en
          <a class="link" href="/en/life/amsterdam.2016">Amsterdam</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>BALI2015</td>
      <td>
        @ru
          <a class="link" href="/life/bali.2016">Бали</a>
        @en
          <a class="link" href="/en/life/bali.2016">Bali</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>BARCELONE2015</td>
      <td>
        @ru
          <a class="link" href="/life/barcelona.2016">Барселона</a>
        @en
          <a class="link" href="/en/life/barcelona.2016">Barcelona</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>BELGIQUE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>BERLIN2015</td>
      <td>
        @ru
          <a class="link" href="/life/berlin.2016">Берлин</a>
        @en
          <a class="link" href="/en/life/berlin.2016">Berlin</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>BOURGOGNE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>BRUXELLES2015</td>
      <td></td>
    </tr>
    <tr>
      <td>BUDAPEST2015</td>
      <td></td>
    </tr>
    <tr>
      <td>COPENHAGUE2015</td>
      <td>
        @ru
          <a class="link" href="/life/copenhagen.2017">Копенгаген</a>
        @en
          <a class="link" href="/en/life/copenhagen.2017">Copenhagen</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>CROATIE2015</td>
      <td>
        @ru
          <a class="link" href="/life/budapest.2017.01">Будапешт</a>
        @en
          <a class="link" href="/en/life/budapest.2017.01">Budapest</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>DUBLIN2015</td>
      <td></td>
    </tr>
    <tr>
      <td>ECOSSE2015</td>
      <td>
        @ru
          <a class="link" href="/life/cologne.2016">Кельн</a>
        @en
          <a class="link" href="/en/life/cologne.2016">Cologne</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>ESPAGNE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>FLORENCE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>IRLANDE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>ISRAEL2015</td>
      <td></td>
    </tr>
    <tr>
      <td>ISTANBUL2015</td>
      <td></td>
    </tr>
    <tr>
      <td>LISBONNE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>LONDRES2015</td>
      <td></td>
    </tr>
    <tr>
      <td>NEWYORK2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MADRID2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MALTE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MAROC2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MARSEILLE2016</td>
      <td></td>
    </tr>
    <tr>
      <td>MIAMI2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MILAN2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MONTREAL2015</td>
      <td></td>
    </tr>
    <tr>
      <td>MOSCOU2015</td>
      <td>
        @ru
          <a class="link" href="/life/msk.2016.06">Москва</a>
        @en
          <a class="link" href="/en/life/msk.2016.06">Moscow</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>NORVEGE2015</td>
      <td>
        @ru
          <a class="link" href="/life/krasnodar.2016">Краснодар</a>
        @en
          <a class="link" href="/en/life/krasnodar.2016">Krasnodar</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>NYC2015</td>
      <td></td>
    </tr>
    <tr>
      <td>NEWYORK2015</td>
      <td></td>
    </tr>
    <tr>
      <td>POLOGNE2015</td>
      <td>
        @ru
          <a class="link" href="/life/spb.2016.03">Санкт-Петербург</a>
        @en
          <a class="link" href="/en/life/spb.2016.03">Saint Petersburg</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>PORTUGAL2015</td>
      <td></td>
    </tr>
    <tr>
      <td>PRAGUE2015</td>
      <td>
        @ru
          <a class="link" href="/life/prague.2016">Прага</a>
        @en
          <a class="link" href="/en/life/prague.2016">Prague</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>ROME2015</td>
      <td></td>
    </tr>
    <tr>
      <td>SARDAIGNE2015</td>
      <td>
        @ru
          <a class="link" href="/life/wiesbaden.2016">Висбаден</a>
        @en
          <a class="link" href="/en/life/wiesbaden.2016">Wiesbaden</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>SICILE2015</td>
      <td></td>
    </tr>
    <tr>
      <td>STOCKHOLM2015</td>
      <td>
        @ru
          <a class="link" href="/life/stockholm.2016">Стокгольм</a>
        @en
          <a class="link" href="/en/life/stockholm.2016">Stockholm</a>
        @endru
      </td>
    </tr>
    <tr>
      <td>SF2015</td>
      <td></td>
    </tr>
    <tr>
      <td>SANFRANCISCO2015</td>
      <td></td>
    </tr>
    <tr>
      <td>VIENNE2015</td>
      <td>
        @ru
          <a class="link" href="/life/vienna.2017">Вена</a>
        @en
          <a class="link" href="/en/life/vienna.2017">Vienna</a>
        @endru
      </td>
    </tr>
  </tbody>
</table>

<div class="row">
  <div class="col-md-6">
    @ru
      <p class="mt-3">Возможно, вас смущает, что в названиях купонов указан 2015 год. Дело в том, что они были введены в период начала активного международного роста сервиса Airbnb. С тех пор прошло достаточно много времени — пользовательская база стала многомиллионной. Новых купонов с 2015 года так и не появлялось, что приводит к неутешительному прогнозу — скоро и эти могут перестать работать. Если они уже не срабатывают, то можно попробовать поменять год в купоне на 2016, 2017 и т.п. или же воспользоваться скидкой для новых пользователей. О ней ниже.</p>

      <h2>Новый пользователь Airbnb?</h2>
      <p>Вы можете рассчитывать на еще большую скидку на вашу первую поездку.</p>
      <a class="btn btn-primary" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">Получить скидку 1500 ₽</a>
      <div class="form-help">После клика вы будете перемещены на сайт airbnb.ru</div>
    @en
      <h2>New Airbnb user?</h2>
      <p>Then you can get even bigger discount for your first trip.</p>
      <a class="btn btn-primary" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">Get $25 coupon</a>
      <div class="form-help">After a click you will be redirected to airbnb.com</div>
    @endru
  </div>
</div>
@endsection
