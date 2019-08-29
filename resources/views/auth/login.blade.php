@extends('base')

@section('content')
<div class="mx-auto max-w-sm">
  <div class="text-center mb-4">
    <h3>{{ trans('auth.signin_title') }}</h3>

    <div class="flex justify-center my-4">
      <div class="mr-2">
        <a class="btn bg-vk text-xl rounded-full text-white hover:text-white" href="{{ path('Auth\Vk@index') }}">
          @svg (vk)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.vk') }}</div>
      </div>
      <div class="mr-2">
        <a class="btn bg-facebook text-xl rounded-full text-white hover:text-white" href="{{ path('Auth\Facebook@index') }}">
          @svg (facebook)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.facebook') }}</div>
      </div>
      <div>
        <a class="btn bg-google text-xl rounded-full text-white hover:text-white" href="{{ path('Auth\Google@index') }}">
          @svg (google)
        </a>
        <div class="mt-1 text-xs text-muted">{{ trans('auth.google') }}</div>
      </div>
    </div>
    <div>{{ trans('auth.or') }}</div>
  </div>

  <form action="{{ path('Auth\SignIn@login') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="mb-4">
      <input
        autofocus
        required
        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
        name="email"
        value="{{ old('email') }}"
        autocomplete="email"
        placeholder="{{ trans('auth.email_or_login') }}"
      >
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>

    <div class="mb-4 relative">
      <input
        required
        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
        type="password"
        name="password"
        autocomplete="current-password"
        placeholder="{{ trans('auth.password') }}"
      >
      <span class="form-control-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="{{ trans('auth.show_password') }}">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="{{ trans('auth.hide_password') }}">
          @svg (eye-slash)
        </span>
      </span>
      <div class="invalid-feedback">{{ $errors->first('password') }}</div>
    </div>

    <div class="flex items-center justify-between">
      <div>
        <label class="flex items-center font-normal mb-0">
          <input class="mr-2" type="checkbox" name="foreign" {{ old('foreign') ? 'checked' : '' }}>
          {{ trans('auth.dont_remember') }}
        </label>
      </div>
      <div>
        <a class="link" href="{{ path('Auth\ForgotPassword@index') }}">{{ trans('auth.forgot_password') }}</a>
      </div>
    </div>

    <div class="mt-4 text-center">
      <button class="btn btn-primary text-lg px-4 py-2 w-40">
        {{ trans('auth.signin') }}
      </button>
      <div class="mt-6">
        <a class="link" href="{{ path('Auth\NewAccount@index') }}">{{ trans('auth.new_account') }}</a>
      </div>
    </div>
  </form>
</div>
@endsection
