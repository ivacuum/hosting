@extends('my.base')

@section('content')
<div class="max-w-[500px]">
  <h3 class="mb-4">@lang('Профиль')</h3>
  <p><a class="btn btn-default" href="{{ Auth::user()->www() }}">@lang('Просмотреть профиль') @svg (angle-right)</a></p>
  <form action="@lng/my/profile" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="mb-4">
      <label class="font-bold">@lang('Логин')</label>
      <input
        class="form-input"
        type="text"
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
      <label class="font-bold">@lang('auth.email')</label>
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
      @lang('Сохранить изменения')
    </button>
  </form>

  <h3 class="mt-12">@lang('Аватар')</h3>
  <avatar-uploader
    delete-action="@lng/my/avatar"
    update-action="@lng/my/avatar"
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
