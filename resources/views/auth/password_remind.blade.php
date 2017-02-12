@extends('base')

@section('content')
<div class="form-signin">
  <h3 class="mb-4 text-center">{{ trans('auth.password_remind_title') }}</h3>
  <form action="{{ action('Auth@passwordRemindPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input autofocus required type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ trans('auth.email') }}">
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
