@extends('base')

@section('content')
<div class="tw-mx-auto tw-max-w-sm">
  <div class="tw-text-center tw-mb-4">
    <h3>{{ trans('auth.signin_title') }}</h3>

    <div class="tw-flex tw-justify-center tw-my-4">
      <div class="tw-mr-2">
        <a class="btn bg-vk f20 rounded-circle tw-text-white hover:tw-text-white" href="{{ path('Auth\Vk@index') }}">
          @svg (vk)
        </a>
        <div class="tw-mt-1 small text-muted">{{ trans('auth.vk') }}</div>
      </div>
      <div class="tw-mr-2">
        <a class="btn bg-facebook f20 rounded-circle tw-text-white hover:tw-text-white" href="{{ path('Auth\Facebook@index') }}">
          @svg (facebook)
        </a>
        <div class="tw-mt-1 small text-muted">{{ trans('auth.facebook') }}</div>
      </div>
      <div>
        <a class="btn bg-google f20 rounded-circle tw-text-white hover:tw-text-white" href="{{ path('Auth\Google@index') }}">
          @svg (google)
        </a>
        <div class="tw-mt-1 small text-muted">{{ trans('auth.google') }}</div>
      </div>
    </div>
    <div>{{ trans('auth.or') }}</div>
  </div>

  <form action="{{ path('Auth\SignIn@login') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="form-group">
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

    <div class="form-group tw-relative">
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

    <div class="tw-flex tw-justify-between">
      <div>
        <label class="form-check">
          <input class="form-check-input" type="checkbox" name="foreign" {{ old('foreign') ? 'checked' : '' }}>
          {{ trans('auth.dont_remember') }}
        </label>
      </div>
      <div>
        <a class="link" href="{{ path('Auth\ForgotPassword@index') }}">{{ trans('auth.forgot_password') }}</a>
      </div>
    </div>

    <div class="tw-mt-4 tw-text-center">
      <button class="btn btn-primary btn-lg btn-login">
        {{ trans('auth.signin') }}
      </button>
      <div class="tw-mt-6">
        <a class="link" href="{{ path('Auth\NewAccount@index') }}">{{ trans('auth.new_account') }}</a>
      </div>
    </div>
  </form>
</div>
@endsection
