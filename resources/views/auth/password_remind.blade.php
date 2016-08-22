@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin">
  <h3>Восстановление пароля</h3>
  <form action="/auth/password/remind" method="post">
    <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <label class="control-label">Электронная почта:</label>
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">
      Начать восстановление
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
