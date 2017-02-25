@component('mail::message')

@ru
  # Ваш промокод: {{ config('cfg.firstvds_promocode') }}
@en
  # Your promo code: {{ config('cfg.firstvds_promocode') }}
@endlang

@ru
  Введите код в соответствующее поле при заказе виртуального сервера. Код можно использовать неограниченное количество раз при заказе новых VPS и VDS. Вашу скидку вы можете увидеть в левом меню биллинга в разделе «скидки».
@endlang

@component('mail::button', ['url' => config('cfg.firstvds_link')])
@ru Перейти на сайт firstvds.ru @en Go to firstvds.ru @endlang
@endcomponent
@endcomponent
