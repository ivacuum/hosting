@extends('base')

@section('content')
<div class="form-signin text-center">
  <h3 class="mt-0 mb-4">{{ trans('auth.signin_title') }}</h3>
  <form action="{{ path('Auth\SignIn@login') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email_or_login') }}">
      @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>

    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
      <input required class="form-control" type="password" name="password" placeholder="{{ trans('auth.password') }}">
      <span class="form-control-feedback form-control-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="{{ trans('auth.show_password') }}">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="{{ trans('auth.hide_password') }}">
          @svg (eye-slash)
        </span>
      </span>
      @if ($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>

    <div class="my-3 clearfix">
      <div class="pull-left">
        <a class="link" href="{{ path('Auth\ForgotPassword@index') }}">{{ trans('auth.forgot_password') }}</a>
      </div>
      <div class="pull-right">
        <a class="link" href="{{ path('Auth\NewAccount@index') }}">{{ trans('auth.new_account') }}</a>
      </div>
    </div>

    <button class="btn btn-primary btn-lg btn-login">
      {{ trans('auth.signin') }}
    </button>

    <h3 class="text-center mt-5">{{ trans('auth.social_signin') }}</h3>

    <div class="text-center mt-3">
      <a class="btn btn-social bg-vk tooltipped tooltipped-n"
         href="{{ path('Auth\Vk@index') }}"
         aria-label="{{ trans('auth.signin_vk') }}">
        @svg (vk)
      </a>
      <a class="btn btn-social bg-fb tooltipped tooltipped-n"
         href="{{ path('Auth\Facebook@index') }}"
         aria-label="{{ trans('auth.signin_facebook') }}">
        @svg (facebook)
      </a>
      <a class="btn btn-social bg-google tooltipped tooltipped-n"
         href="{{ path('Auth\Google@index') }}"
         aria-label="{{ trans('auth.signin_google') }}">
        @svg (google)
      </a>
    </div>

    {{ csrf_field() }}
  </form>
</div>
@endsection
