@extends('base')

@section('content')
<div class="form-signin">
  <h3 class="mt-0 mb-4 text-center">{{ trans('auth.password_remind_title') }}</h3>
  <form action="{{ path('Auth@passwordRemindPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required class="form-control" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
      @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary btn-lg">
        {{ trans('auth.password_remind') }}
      </button>
    </div>

    {{ csrf_field() }}
  </form>
</div>
@endsection
