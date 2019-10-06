@extends('my.base')

@section('content')
<h3 class="mb-4">{{ trans('my.settings') }}</h3>

<div>
  <form action="{{ path([App\Http\Controllers\MySettings::class, 'update']) }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="mb-4">
      <div class="font-bold">{{ trans('my.theme') }}</div>
      <label class="flex items-center">
        <input
          class="mr-2 {{ $errors->has('theme') ? 'is-invalid' : '' }}"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_LIGHT }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}
        >
        {{ trans('my.theme_light') }}
      </label>
      <label class="flex items-center">
        <input
          class="mr-2 {{ $errors->has('theme') ? 'is-invalid' : '' }}"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_DARK }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_DARK ? 'checked' : '' }}
        >
        {{ trans('my.theme_dark') }}
      </label>
      @if ($errors->has('theme'))
        <div class="invalid-feedback block">{{ $errors->first('theme') }}</div>
      @endif
    </div>

    <div class="font-bold">{{ trans('torrents.index') }}</div>
    <div class="mb-4">
      <input type="hidden" name="torrent_short_title" value="0">
      <label class="flex items-center">
        <input
          class="mr-2 {{ $errors->has('torrent_short_title') ? 'is-invalid' : '' }}"
          type="checkbox"
          name="torrent_short_title"
          value="1"
          {{ old('torrent_short_title', Auth::user()->torrent_short_title) ? 'checked' : '' }}
        >
        {{ trans('my.torrent_short_title') }}
      </label>
      @if ($errors->has('torrent_short_title'))
        <div class="invalid-feedback block">{{ $errors->first('torrent_short_title') }}</div>
      @endif
      @ru
        <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
      @endru
    </div>

    <div class="mb-4">
      <div class="font-bold">{{ trans('my.locale') }}</div>
      @foreach (Arr::sort(array_keys(config('cfg.locales'))) as $loc)
        <label class="flex items-center">
          <input
            class="mr-2 {{ $errors->has('locale') ? 'is-invalid' : '' }}"
            type="radio"
            name="locale"
            value="{{ $loc }}"
            {{ old('locale', Auth::user()->locale ?: config('app.locale')) === $loc ? 'checked' : '' }}
          >
          {{ trans("locale.{$loc}") }}
        </label>
      @endforeach
      @if ($errors->has('locale'))
        <div class="invalid-feedback block">{{ $errors->first('locale') }}</div>
      @endif
    </div>

    <div class="font-bold">{{ trans('my.mail_subscriptions') }}</div>
    <input type="hidden" name="notify_gigs" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="mr-2 {{ $errors->has('notify_gigs') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="notify_gigs"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_gigs', Auth::user()->notify_gigs) ? 'checked' : '' }}
      >
      {{ trans('my.notify_gigs') }}
    </label>
    @if ($errors->has('notify_gigs'))
      <div class="invalid-feedback block mb-2">{{ $errors->first('notify_gigs') }}</div>
    @endif

    <input type="hidden" name="notify_news" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="mr-2 {{ $errors->has('notify_news') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="notify_news"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_news', Auth::user()->notify_news) ? 'checked' : '' }}
      >
      {{ trans('my.notify_news') }}
    </label>
    @if ($errors->has('notify_news'))
      <div class="invalid-feedback block mb-2">{{ $errors->first('notify_news') }}</div>
    @endif

    <div class="mb-4">
      <input type="hidden" name="notify_trips" value="{{ App\User::NOTIFY_NO }}">
      <label class="flex items-center">
        <input
          class="mr-2 {{ $errors->has('notify_trips') ? 'is-invalid' : '' }}"
          type="checkbox"
          name="notify_trips"
          value="{{ App\User::NOTIFY_MAIL }}"
          {{ old('notify_trips', Auth::user()->notify_trips) ? 'checked' : '' }}
        >
        {{ trans('my.notify_trips') }}
      </label>
      @if ($errors->has('notify_trips'))
        <div class="invalid-feedback block mb-2">{{ $errors->first('notify_trips') }}</div>
      @endif
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>
  </form>
</div>
@endsection
