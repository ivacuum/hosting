@extends('my.base')

@section('content')
<h3 class="mb-4">@lang('Пароль')</h3>

<div class="max-w-500px">
  <form action="@lng/my/password" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    @if ($hasPassword)
      <div class="mb-4">
        <label class="font-bold">@lang('Текущий пароль')</label>
        <input
          required
          class="form-input"
          type="password"
          name="password"
          autocomplete="current-password"
        >
        <x-invalid-feedback field="password"/>
      </div>
    @endif

    <div class="mb-4">
      <label class="font-bold">@lang('Новый пароль')</label>
      <input
        required
        class="form-input"
        type="password"
        name="new_password"
        minlength="8"
        autocomplete="new-password"
      >
      <x-invalid-feedback field="new_password"/>
      <div class="form-help">
        @ru
          Не менее 8 символов
        @en
          Minimum length is 8 characters
        @endru
      </div>
    </div>

    <button class="btn btn-primary">
      @lang('Сохранить изменения')
    </button>
  </form>
</div>

@if ($hasPassword)
  <h3 class="mt-12">@lang('auth.forgot_password')</h3>
  <form action="{{ path([App\Http\Controllers\Auth\ForgotPassword::class, 'sendResetLink']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    @ru
      <p>Ссылка будет отправлена на вашу электронную почту <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @en
      <p>The link will be sent to your e-mail <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @endru

    <button class="btn btn-default">
      @lang('auth.password_remind')
    </button>

    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
  </form>
@endif
@endsection
