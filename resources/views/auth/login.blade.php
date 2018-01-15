@extends('base')

@section('content')
<div class="mx-auto mw-400">
  <div class="text-center mb-3">
    <h3>{{ trans('auth.signin_title') }}</h3>

    <div class="my-3">
      <a class="btn bg-vk text-white" href="{{ path('Auth\Vk@index') }}" rel="nofollow">
        {{ trans('auth.vk') }}
      </a>
      <a class="btn bg-facebook text-white" href="{{ path('Auth\Facebook@index') }}" rel="nofollow">
        {{ trans('auth.facebook') }}
      </a>
      <a class="btn bg-google text-white" href="{{ path('Auth\Google@index') }}" rel="nofollow">
        {{ trans('auth.google') }}
      </a>
    </div>
    <div>{{ trans('auth.or') }}</div>
  </div>

  <form action="{{ path('Auth\SignIn@login') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group">
      <input autofocus required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email_or_login') }}">
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>

    <div class="form-group position-relative">
      <input required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="{{ trans('auth.password') }}">
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

    <div class="d-flex justify-content-between">
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

    <div class="mt-3 text-center">
      <button class="btn btn-primary btn-lg btn-login">
        {{ trans('auth.signin') }}
      </button>
      <div class="mt-4">
        <a class="link" href="{{ path('Auth\NewAccount@index') }}">{{ trans('auth.new_account') }}</a>
      </div>
    </div>

    {{ csrf_field() }}
  </form>
</div>
@endsection
