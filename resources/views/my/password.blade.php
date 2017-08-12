@extends('my.base')

@section('content')
<h3 class="mt-2 mb-3">{{ trans('my.password') }}</h3>

<div class="row">
  <div class="col-md-6">
    <form action="{{ path("$self@update") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}

      @if ($has_password)
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
          <label>{{ trans('my.old_password') }}</label>
          <input required type="password" class="form-control" name="password">
          @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>
      @endif

      <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
        <label>{{ trans('my.new_password') }}</label>
        <input required type="password" class="form-control" name="new_password">
        @if ($errors->has('new_password'))
          <span class="help-block">{{ $errors->first('new_password') }}</span>
        @else
          @ru
            <span class="help-block">Не менее 6 символов</span>
          @en
            <span class="help-block">Minimum length is 6 characters</span>
          @endlang
        @endif
      </div>

      <button type="submit" class="btn btn-primary">
        {{ trans('my.save') }}
      </button>

      {{ method_field('put') }}
      {{ csrf_field() }}
    </form>
  </div>
</div>

@if ($has_password)
  <h3 class="mt-5">{{ trans('auth.forgot_password') }}</h3>
  <form action="{{ path('Auth@passwordRemindPost') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    @ru
      <p>Ссылка будет отправлена на вашу электронную почту <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @en
      <p>The link will be sent to your e-mail <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @endlang

    <button type="submit" class="btn btn-default">
      {{ trans('auth.password_remind') }}
    </button>

    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
    {{ csrf_field() }}
  </form>
@endif
@endsection
