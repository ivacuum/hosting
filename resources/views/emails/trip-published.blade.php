@component('mail::message')

# {{ $model->metaTitle() }}

{{ trans('mail.trip_published') }}

@component('mail::button', ['url' => $email->signedLink($model->wwwLocale(null, $user->locale))])
{{ trans('mail.read') }}
@endcomponent

@component('mail::button', ['color' => 'light', 'url' => $email->signedLink(path_locale('MySettings@edit', [], false, $user->locale))])
{{ trans('mail.settings') }}
@endcomponent
@endcomponent
