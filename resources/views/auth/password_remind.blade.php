@extends('base')

@section('content')
<div class="mx-auto mw-400">
  <h3>{{ trans('auth.password_remind_title') }}</h3>
  <form action="{{ path('Auth\ForgotPassword@sendResetLink') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="my-3">
      <input autofocus required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>

    <button class="btn btn-primary btn-lg">
      {{ trans('auth.password_remind') }}
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
