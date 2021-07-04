@extends('base')

@section('content')
<div class="mx-auto max-w-[400px]">
  <h3 class="mb-4">@lang('auth.register_title')</h3>
  <form action="{{ path([App\Http\Controllers\Auth\NewAccount::class, 'register']) }}" method="post">
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
        placeholder="@lang('auth.email')"
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
        placeholder="@lang('Пароль')"
      >
      <x-invalid-feedback field="password"/>
    </div>

    <button class="btn btn-primary text-lg px-4 py-2">
      @lang('auth.signup')
    </button>
  </form>
</div>
@endsection
