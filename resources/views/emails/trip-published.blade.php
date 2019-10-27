<?php
/**
 * @var \App\Trip $trip
 * @var string $tripLink
 * @var string $mySettingsLink
 */
?>

@component('mail::message')

# {{ $trip->metaTitle() }}

{{ trans('mail.trip_published') }}

{{ $trip->metaDescription() }}

@if ($trip->meta_image)
<a href="{{ $tripLink }}">
  ![{{ $trip->title }}]({{ $trip->metaImage(500, 375) }})
</a>
@endif

@component('mail::button', ['url' => $tripLink])
{{ trans('mail.read') }}
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $mySettingsLink])
{{ trans('mail.settings') }}
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent
