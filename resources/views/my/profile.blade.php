@extends('my.base')

@section('content')
<div class="mw-500">
  <h3 class="mb-3">{{ trans('my.profile') }}</h3>
  <form action="{{ path("$self@update") }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group">
      <label>{{ trans('my.username') }}</label>
      <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" value="{{ old('username', Auth::user()->login) }}">
      <div class="invalid-feedback">{{ $errors->first('username') }}</div>
      @ru
        <div class="form-help">От 2 до 32 символов. Первый символ логина будет использован для аватарки. В случае его отсутствия — первый символ адреса электронной почты</div>
      @en
        <div class="form-help">From 2 to 32 characters. First two characters would be used as an avatar. In case of empty username, first two characters of email would be used.</div>
      @endru
    </div>

    <div class="form-group">
      <label>{{ trans('auth.email') }}</label>
      <input required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email', Auth::user()->email) }}">
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>

    {{ method_field('put') }}
    {{ csrf_field() }}
  </form>

  <h3 class="mt-5">Аватар</h3>
  <avatar-uploader action="{{ path('MyAvatar@update') }}" current_avatar="{{ Auth::user()->avatarUrl() }}"></avatar-uploader>
</div>
@endsection
