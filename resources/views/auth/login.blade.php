@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin">
  <h3>Вход на сайт</h3>
  <form action="/auth/login" method="post">
    <input hidden type="text" name="mail" value="{{ old('mail') }}">

    <div class="form-group">
      <label>Электронная почта:</label>
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
    </div>

    <div class="form-group has-feedback">
      <label>Пароль:</label>
      <a href="/auth/password/remind" class="link">забыли пароль?</a>
      <input required type="password" class="form-control" name="password">
      <span class="form-control-feedback form-control-feedback-password js-password-eye">
        <span class="js-password-eye-show" title="Показать пароль">
          @php (require base_path('resources/svg/eye.html'))
        </span>
        <span hidden class="js-password-eye-hide" title="Скрыть пароль">
          @php (require base_path('resources/svg/eye-slash.html'))
        </span>
      </span>
    </div>

    <div class="checkbox">
      <label><input type="checkbox" name="foreign"> Чужой компьютер?</label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">
      Войти
    </button>

    <p class="lead text-center" style="margin: 1em 0;">или</p>

    <a href="/auth/register" class="btn btn-default btn-lg btn-block">
      Зарегистрироваться
    </a>

    {{ csrf_field() }}
  </form>
</div>
@endsection
