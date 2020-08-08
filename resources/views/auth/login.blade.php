@extends('base')

@section('content')
<div class="mx-auto max-w-sm">
  <div class="text-center mb-4">
    <h3>{{ trans('auth.signin_title') }}</h3>

    <div class="flex justify-center my-4">
      <div class="mr-2">
        <a
          class="btn bg-vk-600 text-xl rounded-full text-white hover:bg-vk-700 hover:text-white"
          href="{{ path([App\Http\Controllers\Auth\Vk::class, 'index']) }}"
        >
          @svg (vk)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.vk') }}</div>
      </div>
      <div class="mr-2">
        <a
          class="btn bg-facebook-600 text-xl rounded-full text-white hover:bg-facebook-700 hover:text-white"
          href="{{ path([App\Http\Controllers\Auth\Facebook::class, 'index']) }}"
        >
          @svg (facebook)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.facebook') }}</div>
      </div>
      <div>
        <a
          class="btn bg-google-600 text-xl rounded-full text-white hover:bg-google-700 hover:text-white"
          href="{{ path([App\Http\Controllers\Auth\Google::class, 'index']) }}"
        >
          @svg (google)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.google') }}</div>
      </div>
    </div>
    <div>{{ trans('auth.or') }}</div>
  </div>

  <form action="{{ path([App\Http\Controllers\Auth\SignIn::class, 'login']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="mb-4">
      <input
        required
        class="form-input"
        tabindex="1"
        name="email"
        value="{{ old('email') }}"
        autocomplete="email"
        placeholder="{{ trans('auth.email_or_login') }}"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <div class="mb-4 relative">
      <input
        required
        class="form-input"
        tabindex="2"
        type="password"
        name="password"
        autocomplete="current-password"
        placeholder="{{ __('Пароль') }}"
      >
      <span class="form-input-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="{{ trans('auth.show_password') }}">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="{{ trans('auth.hide_password') }}">
          @svg (eye-slash)
        </span>
      </span>
      <x-invalid-feedback field="password"/>
    </div>

    <div class="flex items-center justify-between">
      <div>
        <label class="flex items-center">
          <input class="form-checkbox mr-2" tabindex="3" type="checkbox" name="foreign" {{ old('foreign') ? 'checked' : '' }}>
          {{ trans('auth.dont_remember') }}
        </label>
      </div>
      <div>
        <a
          class="link"
          href="{{ path([App\Http\Controllers\Auth\ForgotPassword::class, 'index']) }}"
        >{{ trans('auth.forgot_password') }}</a>
      </div>
    </div>

    <div class="mt-4 text-center">
      <button class="btn btn-primary text-lg py-2 w-40">
        {{ trans('auth.signin') }}
      </button>
      <div class="mt-6">
        <a
          class="link"
          href="{{ path([App\Http\Controllers\Auth\NewAccount::class, 'index']) }}"
        >{{ trans('auth.new_account') }}</a>
      </div>
    </div>
  </form>
</div>
@endsection
