<?php
/**
 * @var \App\News $news
 * @var string $newsLink
 * @var string $mySettingsLink
 */
?>

@component('mail::message')

@lang('mail.news_published', ['title' => $news->title])

@component('mail::button', ['url' => $newsLink])
@lang('mail.read')
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $mySettingsLink])
@lang('mail.settings')
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
