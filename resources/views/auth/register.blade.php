@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="boxed-group form-signin">
  <h3>Регистрация на сайте</h3>
  <div class="boxed-group-inner">
    <form action="/auth/register" method="post">
      <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">
      
      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label">Электронная почта:</label>
        <input required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label class="control-label">Пароль:</label>
        <input required type="password" class="form-control" name="password">
      </div>
    
      <button type="submit" class="btn btn-primary btn-lg btn-block">
        Зарегистрироваться
      </button>
      
      {{ csrf_field() }}
    </form>
  </div>
</div>
@stop
