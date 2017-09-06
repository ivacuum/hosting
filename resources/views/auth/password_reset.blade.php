@extends('base')

@section('content')
<div class="form-signin">
  <h3 class="mt-0 mb-4 text-center">{{ trans('auth.password_reset_title') }}</h3>
  <form action="{{ path('Auth\ResetPassword@reset') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required class="form-control" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
      @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <input required class="form-control" type="password" name="password" placeholder="{{ trans('auth.new_password') }}">
      @if ($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>

    <div class="text-center">
      <button class="btn btn-primary btn-lg">
        {{ trans('auth.change_password') }}
      </button>
    </div>

    <input type="hidden" name="token" value="{{ $token }}">
    {{ csrf_field() }}
  </form>
</div>
@endsection
