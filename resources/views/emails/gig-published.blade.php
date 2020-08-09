<?php
/**
 * @var \App\Gig $gig
 * @var string $gigLink
 * @var string $mySettingsLink
 */
?>

@component('mail::message')

# {{ $gig->metaTitle() }}

@lang('mail.gig_published')

{{ $gig->metaDescription() }}

@if ($gig->meta_image)
<a href="{{ $gigLink }}">
  ![{{ $gig->title }}]({{ $gig->meta_image }})
</a>
@endif

@component('mail::button', ['url' => $gigLink])
@lang('mail.read')
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $mySettingsLink])
@lang('mail.settings')
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
