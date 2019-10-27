<?php
/**
 * @var \App\Issue $issue
 * @var \App\Comment $comment
 */
?>

@component('mail::message')

Здравствуйте!

{{ ViewHelper::dateShort($issue->created_at) }} вы оставили нам сообщение на тему **{{ $issue->title }}** со страницы {{ url($issue->page) }}.

## Наш комментарий

{{ $comment->html }}

## Текст вашего обращения

{{ $issue->text }}

@include('vendor.mail.html.hit')
@endcomponent
