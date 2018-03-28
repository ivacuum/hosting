@component('mail::message')

@ru
  Ваша почта была указана в качестве контактной при оформлении подписки на получение новых материалов сайта **vacuum.name**. Мы хотим убедиться, что запрос отправили действительно вы, поэтому просим пройти по ссылке для подтверждения.

  Выбранные уведомления:
@en
  Subscription request was sent with this email address. We want to be sure it was really you, so in order to send you notifications about new posts on **vacuum.name** we ask you to follow the link below.

  Selected notifications:
@endru
@foreach ($subscriptions as $subscription)
  - {{ trans("my.notify_{$subscription}") }}
@endforeach

@component('mail::button', ['url' => $email->signedLink(path('Subscriptions@confirm', compact('hash')))])
@ru Подтвердить подписку @en Confirm subscription @endru
@endcomponent

@ru
  Запрос отправил кто-то другой, указав вашу почту? Сообщите нам об этом.
@en
  Someone else made the request with your email? Please tell us.
@endru

@component('mail::button', ['color' => 'light', 'url' => $email->signedLink($email->reportLink())])
@ru Это не я @en It was not me @endru
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
