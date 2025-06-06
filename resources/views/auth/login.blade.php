@extends('base')

@section('content')
<div class="mx-auto max-w-sm">
  <div class="text-center mb-4">
    <h3 class="font-medium text-2xl">@lang('auth.signin_title')</h3>

    <div class="flex gap-2 justify-center my-4">
      <div>
        <a
          class="bg-vk-600 inline-flex justify-center items-center size-12 text-xl rounded-full text-white hover:bg-vk-700 hover:text-white"
          href="@lng/auth/vk"
        >
          @svg (vk)
        </a>
        <div class="mt-1 text-xs text-gray-500">@lang('auth.vk')</div>
      </div>
      <div>
        <a
          class="bg-google-600 inline-flex justify-center items-center size-12 text-xl rounded-full text-white hover:bg-google-700 hover:text-white"
          href="@lng/auth/google"
        >
          @svg (google)
        </a>
        <div class="mt-1 text-xs text-gray-500">@lang('auth.google')</div>
      </div>
    </div>
    <div class="relative">
      <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300 dark:border-slate-700"></div>
      </div>
      <div class="relative flex justify-center">
        <span class="px-2 bg-white dark:bg-slate-950">
          @lang('auth.or')
        </span>
      </div>
    </div>
  </div>

  <form action="@lng/auth/login" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="mb-4">
      <input
        required
        class="the-input"
        type="text"
        tabindex="1"
        name="email"
        value="{{ old('email') }}"
        autocomplete="email"
        placeholder="@lang('auth.email_or_login')"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <div class="mb-4 relative">
      <input
        required
        class="the-input"
        tabindex="2"
        type="password"
        name="password"
        autocomplete="current-password"
        placeholder="@lang('Пароль')"
      >
      <span class="form-input-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="@lang('auth.show_password')">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="@lang('auth.hide_password')">
          @svg (eye-slash)
        </span>
      </span>
      <x-invalid-feedback field="password"/>
    </div>

    <div class="flex items-center justify-between">
      <div>
        <label class="flex gap-2 items-center">
          <input class="not-checked:border-gray-300 text-sky-600" type="checkbox" name="foreign" {{ old('foreign') ? 'checked' : '' }}>
          @lang('auth.dont_remember')
        </label>
      </div>
      <div>
        <a
          class="link"
          href="{{ path([App\Http\Controllers\Auth\ForgotPassword::class, 'index']) }}"
        >@lang('auth.forgot_password')</a>
      </div>
    </div>

    <div class="mt-4 text-center">
      <button class="btn btn-primary text-lg py-2 w-40">
        @lang('auth.signin')
      </button>
      <div class="mt-6">
        <a
          class="link"
          href="@lng/auth/register"
        >@lang('auth.new_account')</a>
      </div>
    </div>
  </form>
</div>
@endsection
