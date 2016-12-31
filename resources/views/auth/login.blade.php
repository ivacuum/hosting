@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin text-center">
  <h3>Вход на сайт</h3>
  <form action="{{ action('Auth@login') }}" method="post">
    <input hidden type="text" name="mail" value="{{ old('mail') }}">

    <div class="form-group">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Электронная почта">
    </div>

    <div class="form-group has-feedback">
      <input required type="password" class="form-control" name="password" placeholder="Пароль">
      <span class="form-control-feedback form-control-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="Показать пароль">
          @svg (eye)
        </span>
        <span hidden class="js-password-eye-hide" title="Скрыть пароль">
          @svg (eye-slash)
        </span>
      </span>
    </div>

    <div class="m-y-1 clearfix">
      <div class="pull-left"><a class="link" href="/auth/password/remind">Забыли пароль?</a></div>
      {{--<div class="pull-right"><a class="link" href="/auth/register">Регистрация</a></div>--}}
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">
      Войти
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
