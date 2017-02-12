@component('mail::message')

{{ trans('auth.change_password_email') }}

@component('mail::button', ['url' => action('Auth@passwordReset', $token)])
{{ trans('auth.change_password') }}
@endcomponent
@endcomponent
