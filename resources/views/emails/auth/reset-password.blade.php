@component('mail::message')

{{ trans('auth.change_password_email') }}

@component('mail::button', ['url' => path('Auth@passwordReset', $token, true)])
{{ trans('auth.change_password') }}
@endcomponent
@endcomponent
