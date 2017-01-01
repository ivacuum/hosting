@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin">
  <h3>Восстановление пароля</h3>
  <form action="/auth/password/remind" method="post">
    <input hidden type="text" name="mail" value="{{ old('mail') }}">

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Электронная почта">
    </div>

    <button type="submit" class="btn btn-primary btn-lg">
      Начать восстановление
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
