@extends('my.base')

@section('content')
<div class="max-w-500px">
  <h3 class="mb-4">{{ trans('my.profile') }}</h3>
  <p><a class="btn btn-default" href="{{ Auth::user()->www() }}">{{ trans('my.go_to_profile') }} @svg (angle-right)</a></p>
  <form action="{{ path([App\Http\Controllers\MyProfile::class, 'update']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="mb-4">
      <label class="font-bold">{{ trans('my.username') }}</label>
      <input
        class="form-input"
        name="username"
        value="{{ old('username', Auth::user()->login) }}"
      >
      <x-invalid-feedback field="username"/>
      <div class="form-help">
        @ru
          От 2 до 32 символов. Первый символ логина будет использован для аватарки. В случае его отсутствия — первый символ адреса электронной почты
        @en
          From 2 to 32 characters. First two characters would be used as an avatar. In case of empty username, first two characters of email would be used.
        @endru
      </div>
    </div>

    <div class="mb-4">
      <label class="font-bold">{{ trans('auth.email') }}</label>
      <input
        required
        class="form-input"
        type="email"
        name="email"
        value="{{ old('email', Auth::user()->email) }}"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <button class="btn btn-primary">
      {{ __('Сохранить изменения') }}
    </button>
  </form>

  <h3 class="mt-12">{{ __('Аватар') }}</h3>
  <avatar-uploader
    delete-action="{{ path([App\Http\Controllers\MyAvatar::class, 'destroy']) }}"
    update-action="{{ path([App\Http\Controllers\MyAvatar::class, 'update']) }}"
    current-avatar="{{ Auth::user()->avatarUrl() }}"
  >
    @include('tpl.svg-avatar', [
      'bg' => ViewHelper::avatarBg(Auth::user()->id),
      'text' => Auth::user()->avatarName(),
      'classes' => 'w-24 h-24',
    ])
  </avatar-uploader>
</div>
@endsection
