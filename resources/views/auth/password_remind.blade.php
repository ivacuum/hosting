@extends('base')

@section('content')
@include('tpl.form_errors')

<div class="form-signin text-center">
  <h3 class="m-b-2">{{ trans('auth.password_remind_title') }}</h3>
  <form action="{{ action('Auth@passwordRemindPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
    </div>

    <button type="submit" class="btn btn-primary btn-lg">
      {{ trans('auth.password_remind') }}
    </button>

    {{ csrf_field() }}
  </form>
</div>
@endsection
