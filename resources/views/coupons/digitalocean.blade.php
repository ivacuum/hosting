@extends('base')

@section('content')
<h1>{{ $metaTitle }}</h1>
<div class="max-w-[600px]">
  @ru
    <p>Вы когда-нибудь задумывались можно ли бесплатно попробовать услуги одного из лучших хостинг-провайдеров в мире совершенно бесплатно в течение нескольких месяцев? Да, это возможно с помощью промокодов ниже.</p>
  @en
    <p>Have you ever wondered if you could try one of the best web hosting for free for a few months? Yes, you can, thanks to the promo codes below.</p>
  @endru
  <table class="table-stats table-adaptive mb-4">
    <thead>
      <tr>
        <th>@ru Промокод @en Promo Code @endru</th>
        <th>@ru Выгода @en Benefits @endru</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">DO10</span> / <span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">DROPLET10</span></td>
        <td>@ru $10 для новых пользователей @en $10 credit for new users @endru</td>
      </tr>
      <tr>
        <td><span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">BITNAMI</span></td>
        <td>@ru $10 на счет при регистрации @en $10 off for a new account @endru</td>
      </tr>
      <tr>
        <td><span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">ACTIVATE10</span></td>
        <td>@ru $10 на счет для нынешних клиентов @en $10 credit for existing customers @endru</td>
      </tr>
      <tr>
        <td><span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">LOWENDBOX</span> / <span class="bg-greenish-600 text-white p-1 text-xs font-bold rounded">DOPRODUCT</span></td>
        <td>@ru $15 на счет @en $15 DigitalOcean credits @endru</td>
      </tr>
    </tbody>
  </table>
  @ru
    <p>Пожалуйста, учтите, что DigitalOcean разрешает использовать лишь <span class="font-bold">один промокод для каждой учетной записи</span>, поэтому, если вы уже использовали какой-либо промокод ранее, то новый может не сработать.</p>

    <h2>Как получить бесплатные месяцы хостинга</h2>
    <ol>
      <li><a class="link" href="{{ config('cfg.digitalocean_link') }}">Зарегистрируйтесь на сайте DigitalOcean</a>.</li>
      <li>Подтвердите адрес вашей электронной почты.</li>
      <li>Перейдите в «Billing» и примените промокод из списка выше.</li>
      <li>Привяжите банковскую карту или заплатите $5 через PayPal для завершения процесса регистрации на DigitalOcean.</li>
    </ol>
  @en
    <p>Remember that DigitalOcean only allow <span class="font-bold">one promo code per account</span>, so if you have redeemed one in the past you may not be able to add another again.</p>

    <h2>How to get free months of VPS</h2>
    <ol>
      <li><a class="link" href="{{ config('cfg.digitalocean_link') }}">Sign up at DigitalOcean</a>.</li>
      <li>Verify your e-mail.</li>
      <li>Move on to Billing and apply any promo code from the above.</li>
      <li>Link your credit card or pay $5 via PayPal to complete the process.</li>
    </ol>
  @endru
</div>
@endsection
