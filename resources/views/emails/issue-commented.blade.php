<?php
/**
 * @var \App\Issue $issue
 * @var \App\Comment $comment
 */
?>

@component('mail::message')

@ru
Здравствуйте!
@en
Hello
@endru

@ru
{{ ViewHelper::dateShort($issue->created_at) }} вы оставили нам сообщение на тему **{{ $issue->title }}** со страницы {{ url($issue->page) }}.
@en
You left us a message titled **{{ $issue->title }}** on {{ $issue->created_at->isoFormat('LL') }} from {{ url($issue->page) }}.
@endru

@ru
## Наш комментарий
@en
## Our response
@endru

{{ $comment->html }}

@ru
## Текст вашего обращения
@en
## Your message
@endru

{{ $issue->text }}

@include('vendor.mail.html.hit')
@endcomponent
