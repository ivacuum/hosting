@extends('my.base')

@section('content')
<div class="max-w-500px">
  <h3 class="mb-4">{{ trans('my.profile') }}</h3>
  <p><a class="btn btn-default" href="{{ Auth::user()->www() }}">{{ trans('my.go_to_profile') }}</a></p>
  <form action="{{ path("$self@update") }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="mb-4">
      <label>{{ trans('my.username') }}</label>
      <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" value="{{ old('username', Auth::user()->login) }}">
      <div class="invalid-feedback">{{ $errors->first('username') }}</div>
      <div class="form-help">
        @ru
          От 2 до 32 символов. Первый символ логина будет использован для аватарки. В случае его отсутствия — первый символ адреса электронной почты
        @en
          From 2 to 32 characters. First two characters would be used as an avatar. In case of empty username, first two characters of email would be used.
        @endru
      </div>
    </div>

    <div class="mb-4">
      <label>{{ trans('auth.email') }}</label>
      <input required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email', Auth::user()->email) }}">
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>
  </form>

  <h3 class="mt-12">{{ trans('my.avatar') }}</h3>
  <avatar-uploader
    action="{{ path('MyAvatar@update') }}"
    current-avatar="{{ Auth::user()->avatarUrl() }}"
  ></avatar-uploader>
</div>
@endsection
