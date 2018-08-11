@component('mail::message')

# {{ $model->metaTitle() }}

{{ trans('mail.gig_published') }}

{{ $model->metaDescription() }}

@if ($model->meta_image)
<a href="{{ $email->signedLink($model->wwwLocale($user->locale)) }}">
  ![{{ $model->title }}]({{ $model->meta_image }})
</a>
@endif

@component('mail::button', ['url' => $email->signedLink($model->wwwLocale($user->locale))])
{{ trans('mail.read') }}
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $email->signedLink(path_locale('MySettings@edit', [], false, $user->locale))])
{{ trans('mail.settings') }}
@endcomponent

@include('vendor.mail.html.hit')
@endcomponent