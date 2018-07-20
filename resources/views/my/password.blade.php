@extends('my.base')

@section('content')
<h3 class="mb-3">{{ trans('my.password') }}</h3>

<div class="mw-500">
  <form action="{{ path("$self@update") }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    @if ($has_password)
      <div class="form-group">
        <label>{{ trans('my.old_password') }}</label>
        <input required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password">
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
      </div>
    @endif

    <div class="form-group">
      <label>{{ trans('my.new_password') }}</label>
      <input required class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}" type="password" name="new_password">
      <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
      @ru
        <div class="form-help">Не менее 6 символов</div>
      @en
        <div class="form-help">Minimum length is 6 characters</div>
      @endru
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>
  </form>
</div>

@if ($has_password)
  <h3 class="mt-5">{{ trans('auth.forgot_password') }}</h3>
  <form action="{{ path('Auth\ForgotPassword@sendResetLink') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    @ru
      <p>Ссылка будет отправлена на вашу электронную почту <span class="font-weight-bold">{{ Auth::user()->email }}</span></p>
    @en
      <p>The link will be sent to your e-mail <span class="font-weight-bold">{{ Auth::user()->email }}</span></p>
    @endru

    <button class="btn btn-default">
      {{ trans('auth.password_remind') }}
    </button>

    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
  </form>
@endif
@endsection
