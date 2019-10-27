<?php
/**
 * @var \App\News $news
 * @var string $newsLink
 * @var string $mySettingsLink
 */
?>

@component('mail::message')

{{ trans('mail.news_published', ['title' => $news->title]) }}

@component('mail::button', ['url' => $newsLink])
{{ trans('mail.read') }}
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $mySettingsLink])
{{ trans('mail.settings') }}
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
