@extends('my.base')

@section('content')
<h3 class="mb-4">{{ trans('my.password') }}</h3>

<div class="max-w-500px">
  <form action="{{ path([App\Http\Controllers\MyPassword::class, 'update']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    @if ($hasPassword)
      <div class="mb-4">
        <label class="font-bold">{{ trans('my.old_password') }}</label>
        <input
          required
          class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
          type="password"
          name="password"
          autocomplete="current-password"
        >
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
      </div>
    @endif

    <div class="mb-4">
      <label class="font-bold">{{ trans('my.new_password') }}</label>
      <input
        required
        class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
        type="password"
        name="new_password"
        autocomplete="new-password"
      >
      <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
      @ru
        <div class="form-help">Не менее 8 символов</div>
      @en
        <div class="form-help">Minimum length is 8 characters</div>
      @endru
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>
  </form>
</div>

@if ($hasPassword)
  <h3 class="mt-12">{{ trans('auth.forgot_password') }}</h3>
  <form action="{{ path([App\Http\Controllers\Auth\ForgotPassword::class, 'sendResetLink']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    @ru
      <p>Ссылка будет отправлена на вашу электронную почту <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @en
      <p>The link will be sent to your e-mail <span class="font-bold">{{ Auth::user()->email }}</span></p>
    @endru

    <button class="btn btn-default">
      {{ trans('auth.password_remind') }}
    </button>

    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
  </form>
@endif
@endsection
