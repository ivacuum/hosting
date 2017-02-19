@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin text-center">
  <h3 class="mt-0 mb-4">{{ trans('auth.register_title') }}</h3>
  <form action="{{ action('Auth@registerPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <input required type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
    </div>

    <button type="submit" class="btn btn-primary btn-lg">
      {{ trans('auth.signup') }}
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
