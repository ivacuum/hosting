@component('mail::message')

@ru
  # Ваш промокод: {{ App\Domain\Config::FirstVdsPromocode }}
@en
  # Your promo code: {{ App\Domain\Config::FirstVdsPromocode }}
@endru

@ru
  Введите код в соответствующее поле при заказе виртуального сервера. Код можно использовать неограниченное количество раз при заказе новых VPS и VDS. Вашу скидку вы можете увидеть в левом меню биллинга в разделе «скидки».
@endru

@component('mail::button', ['url' => App\Domain\Config::FirstVdsLink->get()])
@ru Перейти на сайт firstvds.ru @en Go to firstvds.ru @endru
@endcomponent
@endcomponent
