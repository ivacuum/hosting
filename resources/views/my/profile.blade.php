@extends('my.base')

@section('content')
<div class="row">
  <div class="col-md-6 mb-3">
    <h3 class="mt-2 mb-3">{{ trans('my.profile') }}</h3>
    <form action="{{ path("$self@update") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}

      <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
        <label>{{ trans('my.username') }}</label>
        <input class="form-control" name="username" value="{{ old('username', Auth::user()->login) }}">
        @if ($errors->has('username'))
          <span class="help-block">{{ $errors->first('username') }}</span>
        @else
          @ru
            <span class="help-block">От 2 до 32 символов. Первый символ логина будет использован для аватарки. В случае его отсутствия — первый символ адреса электронной почты</span>
          @en
            <span class="help-block">From 2 to 32 characters. First two characters would be used as an avatar. In case of empty username, first two characters of email would be used.</span>
          @endru
        @endif
      </div>

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label>{{ trans('auth.email') }}</label>
        <input required class="form-control" type="email" name="email" value="{{ old('email', Auth::user()->email) }}">
        @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
      </div>

      <button class="btn btn-primary">
        {{ trans('my.save') }}
      </button>

      {{ method_field('put') }}
      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-md-6">
    <h3 class="mt-5 mt-md-2">Аватар</h3>
    <avatar-uploader action="{{ path('MyAvatar@update') }}" current_avatar="{{ Auth::user()->avatarUrl() }}"></avatar-uploader>
  </div>
</div>
@endsection
