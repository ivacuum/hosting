@component('mail::message')

{{ trans('auth.change_password_email') }}

@component('mail::button', ['url' => path([App\Http\Controllers\Auth\ResetPassword::class, 'index'], $token, true)])
{{ trans('auth.change_password') }}
@endcomponent
@endcomponent
