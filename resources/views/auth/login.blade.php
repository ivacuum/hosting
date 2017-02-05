@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin text-center">
  <h3 class="mb-4">{{ trans('auth.signin_title') }}</h3>
  <form action="{{ action('Auth@loginPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email_or_login') }}">
    </div>

    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
      <input required type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
      <span class="form-control-feedback form-control-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="{{ trans('auth.show_password') }}">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="{{ trans('auth.hide_password') }}">
          @svg (eye-slash)
        </span>
      </span>
    </div>

    <div class="my-3 clearfix">
      <div class="pull-left">
        <a class="link" href="{{ action('Auth@passwordRemind') }}">{{ trans('auth.forgot_password') }}</a>
      </div>
      <div class="pull-right">
        <a class="link" href="{{ action('Auth@register') }}">{{ trans('auth.new_account') }}</a>
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-login">
      {{ trans('auth.signin') }}
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
