@component('mail::message')

@lang('auth.change_password_email')

@component('mail::button', ['url' => path([App\Http\Controllers\Auth\ResetPassword::class, 'index'], $token, true)])
@lang('auth.change_password')
@endcomponent
@endcomponent
