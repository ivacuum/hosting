@extends('my.base')

@section('content')
<div class="row">
  <div class="col-md-6 mb-3">
    <h3 class="mt-0 mb-3">{{ trans('my.profile') }}</h3>
    <form action="{{ path("$self@profilePut") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}

      <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
        <label>{{ trans('my.username') }}</label>
        <input type="text" class="form-control" name="username" value="{{ old('username', Auth::user()->login) }}">
        @if ($errors->has('username'))
          <span class="help-block">{{ $errors->first('username') }}</span>
        @else
          @ru
            <span class="help-block">От 2 до 32 символов. Первые два символа логина будут использованы для аватарки. В случае его отсутствия — первые два символа адреса электронной почты</span>
          @en
            <span class="help-block">From 2 to 32 characters. First two characters would be used as an avatar. In case of empty username, first two characters of email would be used.</span>
          @endlang
        @endif
      </div>

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label>{{ trans('auth.email') }}</label>
        <input required type="text" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}">
        @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">
        {{ trans("$tpl.save") }}
      </button>

      {{ method_field('put') }}
      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-md-6">
    <h3 class="mt-0">Аватар</h3>
    <avatar-uploader action="{{ path('My@avatarPut') }}" current_avatar="{{ Auth::user()->avatarUrl() }}"></avatar-uploader>
  </div>
</div>
@endsection
