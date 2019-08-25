@extends('base')

@section('content')
<h1>{{ $meta_title }}</h1>
<div class="tw-max-w-600px">
  @ru
    <p>Вы легко можете получить скидку около 10 евро на ваши следующие бронирования на <a class="link" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">airbnb.ru</a> с помощью купонов ниже. Также я привожу информацию где удалось успешно воспользоваться данными купонами. Коды <span class="tw-font-bold">работают для уже зарегистрированных пользователей</span>.</p>
  @en
    <p>You could easily get $36 off your booking cost on <a class="link" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">airbnb.com</a> just by using coupons below. I also provide the info where I successfully applied these coupons. It <span class="tw-font-bold">works for already registered users</span>.</p>
  @endru
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

  @ru
    <p class="tw-mt-4">Возможно, вас смущает, что в названиях купонов указан 2015 год. Дело в том, что они были введены в период начала активного международного роста сервиса Airbnb. С тех пор прошло достаточно много времени — пользовательская база стала многомиллионной. Новых купонов с 2015 года так и не появлялось, что приводит к неутешительному прогнозу — скоро и эти могут перестать работать. Если они уже не срабатывают, то можно попробовать поменять год в купоне на 2016, 2017 и т.п. или же воспользоваться скидкой для новых пользователей. О ней ниже.</p>

    <h2>Новый пользователь Airbnb?</h2>
    <p>Вы можете рассчитывать на еще большую скидку на вашу первую поездку.</p>
    <a class="btn btn-primary" href="https://www.airbnb.ru/{{ config('cfg.airbnb_link') }}">Получить скидку 2100 ₽</a>
    <div class="form-help">После клика вы будете перемещены на сайт airbnb.ru</div>
  @en
    <h2 class="tw-mt-4">New Airbnb user?</h2>
    <p>Then you can get even bigger discount for your first trip.</p>
    <a class="btn btn-primary" href="https://www.airbnb.com/{{ config('cfg.airbnb_link') }}">Get $36 coupon</a>
    <div class="form-help">After a click you will be redirected to airbnb.com</div>
  @endru

  @ru
    <section class="tw-mt-12">
      <h3>Чем вообще хорош Airbnb? Чем плох?</h3>
      <p><strong>Возможность познать местный быт</strong>. Вы столкнетесь с особенностями местного жилья. Сможете посмотреть чем люди пользуются дома, как что расставляют и продумывают — это все прекрасная возможность вдохновиться для обустройства вашего собственного дома.</p>

      <p><strong>Завтраки бывают редко</strong>. Но все же они иногда встречаются, тогда на странице предложения будет соответствующая пометка. На полный пансион едва ли стоит рассчитывать. Зато вы сможете сами купить и попробовать местные продукты, если разберетесь в магазине что есть что :)</p>

      <p><strong>Оплата заранее банковской картой</strong>. Вы сразу платите сервису Airbnb в момент бронирования, а арендодателю он переведет деньги только на следующий день после вашего заселения. Это для гарантии, чтоб вас разместили.</p>

      <p><strong>Отсутствие курсирования налички между вами и арендодателем</strong>. Все выглядит так, словно вас встречают знакомые знакомых. Словно вас друг другу кто-то порекомендовал. Кто бы это мог быть? Airbnb!</p>
    </section>

    <section class="tw-mt-12">
      <h3>Как лучше выбирать жилье? По отзывам?</h3>
      <p><strong>Определитесь чего вам хочется</strong>. В целом предложения можно разделить на следующие типы: общая комната, личная комната, квартира и целый дом.</p>

      <p><strong>Общая комната</strong>. Предложения вроде кушетки в гостиной. Минимум личного пространства и расходов на жилье. Комнат в квартире или доме может сдаваться несколько, тогда появляется шанс оказаться в международной тусовке гостей.</p>

      <p><strong>Личная комната</strong>. Какое-никакое личное пространство уже есть, плюс скорее всего будет возможность закрыть комнату на ключ. Хозяин будет жить по соседству в одной из комнат. Плюс это или минус — смотрите сами. С хозяином можно поболтать за завтраком или ужином, попрактиковать иностранный язык, спросить совета, уточнить куда отправиться в городе и что поделать. Да даже затусить с ним можно! Если арендодатель где-то работает, то половину времени в вашем распоряжении будет чуть ли не вся площадь жилья.</p>

      <p><strong>Квартира</strong>. Вся площадь ваша. Здорово для заселения большой компанией, в том числе с детьми. Не очень здорово, когда квартира пустует без гостей, ведь вид у нее тогда весьма пустынный — своего рода необжитый, как иногда говорят люди. Полезностей вроде зубной пасты, шампуней и прочего чаще всего будет меньше, чем при заселении в личную комнату — все-таки живущий хозяин заинтересован, чтобы дома были все предметы первой необходимости, которыми он в том числе сам и пользуется.</p>

      <p><strong>Целый дом</strong>. Можно рассчитывать на парковку, дворик, балкон, два этажа и прочие прелести. Каких предложений только не бывает!</p>

      <p><strong>Прикиньте необходимый вам район</strong>. Особенно когда приезжаете на какую-нибудь конференцию, выставку, соревнования или фестиваль на несколько дней.</p>

      <p><strong>Обратите внимание на отзывы</strong>. Чем больше отзывов изучите, тем меньше будет неожиданностей. Обычно 2–3 страниц вполне достаточно, чтобы сложилось представление. Особое внимание обратите на критику и ответы на нее. Чем лучше и развернутее отзывы, тем больше вероятность, что вам все понравится. При первых заселениях постарайтесь выбирать предложения хотя бы от четырех звезд и с несколькими десятками отзывов — так вы убедитесь, что сервис хорош.</p>
    </section>

    <section class="tw-mt-12">
      <h3>Как происходит заселение?</h3>
      <p><strong>Как договоритесь с арендодателем</strong>. Ох, чего только не бывает! Вы можете получить ключи из рук в руки как в самом жилье, так и вне него. Вам могут рассказать где найти ключи: в цветочном горшке, в лейке, под ковриком и т.п. Вам могут рассказать где забрать ключи: в киоске через дорогу, у соседа, в курьерской службе в аэропорту и т.д. В конце концов, ключи могут быть вовсе не нужны — бывают случаи, когда достаточно ввести код для доступа в жилье.</p>

      <p><strong>Обязательно обсудите время заселения</strong>. Чаще всего вас будут готовы принять после полудня. Некоторые люди работают, тогда их кто-то подменит или ваша встреча перенесется на вечер. В случае заселения за полночь скорее всего вам расскажут где искать и забирать ключ. В исключительных случаях вас смогут заселить даже утром, но не всегда такая возможность бесплатна.</p>

      <p><strong>Добираться до жилья не всегда обязательно самому</strong>. И речь даже не о такси до дома. Иногда хозяева могут встретить вас в аэропорту или на вокзале, в том числе подбросить на автомобиле, но это не всегда бесплатно. Главный вывод заключается в том, что заселение необходимо обсуждать.</p>

      <p><strong>Для обсуждения необязательно совершать бронирование</strong>. Функция диалога доступна без предварительной оплаты. Задайте вопросы хозяину заранее, если в чем-то сомневаетесь.</p>
    </section>
  @endru

  <section class="tw-mt-12">
    <div class="h3">{{ trans('issues.create') }}</div>
    @ru
      <p>Знаете промокод или другие способы сэкономить на Airbnb? Хотите оставить отзыв или задать вопрос? Используйте форму ниже, чтобы поделиться с нами информацией. По возможности мы дополним эту страницу новыми материалами.</p>
    @en
      <p>Use the form below to ask a question or just to tell us how to make this page better. New coupons and ways to cut down the expenses are welcome.</p>
    @endru
    <feedback-form
      email="{{ Auth::user()->email ?? '' }}"
      title="Airbnb"
      action="{{ path('Issues@store') }}"
      hide-title
    ></feedback-form>
  </section>
</div>
@endsection
