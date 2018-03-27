@component('mail::message')

@ru
  Ваша почта была указана в качестве контактной при написании комментария на сайте **vacuum.name**. Мы хотим убедиться, что его написали действительно вы, поэтому просим пройти по ссылке для подтверждения.
@en
  Comment was sent with this email address. We want to be sure it was really you, so in order to publish the comment we ask you to follow the link below.
@endru

@component('mail::button', ['url' => $email->signedLink(path('CommentConfirm@update', $model))])
@ru Опубликовать комментарий @en Publish the comment @endru
@endcomponent

{{ trans('comments.pending_tip') }}

@ru
  Комментарий оставил кто-то другой, указав вашу почту? Сообщите нам об этом.
@en
  Someone else left the comment with your email? Please tell us.
@endru

@component('mail::button', ['color' => 'light', 'url' => $email->signedLink($email->reportLink())])
@ru Это не я @en It was not me @endru
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
