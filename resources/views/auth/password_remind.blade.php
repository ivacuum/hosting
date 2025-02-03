@extends('base')

@section('content')
<div class="mx-auto max-w-[400px]">
  <h3 class="font-medium text-2xl mb-2">@lang('auth.password_remind_title')</h3>
  <form action="{{ path([App\Http\Controllers\Auth\ForgotPassword::class, 'sendResetLink']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @csrf

    <div class="my-4">
      <input
        autofocus
        required
        class="the-input"
        type="email"
        name="email"
        value="{{ old('email') }}"
        autocomplete="email"
        placeholder="@lang('auth.email')"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <button class="btn btn-primary text-lg px-4 py-2">
      @lang('auth.password_remind')
    </button>
  </form>
</div>
@endsection
