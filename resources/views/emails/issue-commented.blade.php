@component('mail::message')

Здравствуйте!

{{ ViewHelper::dateShort($model->created_at) }} вы оставили нам сообщение на тему **{{ $model->title }}** со страницы {{ url($model->page) }}.

## Наш комментарий

{{ $comment->html }}

## Текст вашего обращения

{{ $model->text }}

@include('vendor.mail.html.hit')
@endcomponent
