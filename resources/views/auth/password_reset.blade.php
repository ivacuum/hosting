@extends('base')

@section('content')
<div class="mx-auto max-w-400px">
  <h3 class="mb-4">{{ trans('auth.password_reset_title') }}</h3>
  <form action="{{ path([App\Http\Controllers\Auth\ResetPassword::class, 'reset']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="mb-4">
      <input
        autofocus
        required
        class="form-input"
        type="email"
        name="email"
        value="{{ old('email') }}"
        autocomplete="email"
        placeholder="{{ trans('auth.email') }}"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <div class="mb-4">
      <input
        required
        class="form-input"
        type="password"
        name="password"
        minlength="8"
        autocomplete="new-password"
        placeholder="{{ trans('auth.new_password') }}"
      >
      <x-invalid-feedback field="password"/>
    </div>

    <button class="btn btn-primary text-lg px-4 py-2">
      {{ trans('auth.change_password') }}
    </button>

    <input type="hidden" name="token" value="{{ $token }}">
  </form>
</div>
@endsection
