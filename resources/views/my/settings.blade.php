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
          class="form-radio mr-2"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_LIGHT }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}
        >
        {{ trans('my.theme_light') }}
      </label>
      <label class="flex items-center">
        <input
          class="form-radio mr-2"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_DARK }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_DARK ? 'checked' : '' }}
        >
        {{ trans('my.theme_dark') }}
      </label>
      <x-invalid-feedback field="theme"/>
    </div>

    <div class="font-bold">{{ __('Торренты') }}</div>
    <div class="mb-4">
      <input type="hidden" name="torrent_short_title" value="0">
      <label class="flex items-center">
        <input
          class="form-checkbox mr-2"
          type="checkbox"
          name="torrent_short_title"
          value="1"
          {{ old('torrent_short_title', Auth::user()->torrent_short_title) ? 'checked' : '' }}
        >
        {{ trans('my.torrent_short_title') }}
      </label>
      <x-invalid-feedback field="torrent_short_title"/>
      @ru
        <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
      @endru
    </div>

    <div class="mb-4">
      <div class="font-bold">{{ trans('my.locale') }}</div>
      @foreach (Arr::sort(array_keys(config('cfg.locales'))) as $loc)
        <label class="flex items-center">
          <input
            class="form-radio mr-2"
            type="radio"
            name="locale"
            value="{{ $loc }}"
            {{ old('locale', Auth::user()->locale ?: config('app.locale')) === $loc ? 'checked' : '' }}
          >
          {{ trans("locale.{$loc}") }}
        </label>
      @endforeach
      <x-invalid-feedback field="locale"/>
    </div>

    <div class="font-bold">{{ trans('my.mail_subscriptions') }}</div>
    <input type="hidden" name="notify_gigs" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="form-checkbox mr-2"
        type="checkbox"
        name="notify_gigs"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_gigs', Auth::user()->notify_gigs) ? 'checked' : '' }}
      >
      {{ __('Концерты') }}
    </label>

    <input type="hidden" name="notify_news" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="form-checkbox mr-2"
        type="checkbox"
        name="notify_news"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_news', Auth::user()->notify_news) ? 'checked' : '' }}
      >
      {{ __('Новости сайта') }}
    </label>

    <div class="mb-4">
      <input type="hidden" name="notify_trips" value="{{ App\User::NOTIFY_NO }}">
      <label class="flex items-center">
        <input
          class="form-checkbox mr-2"
          type="checkbox"
          name="notify_trips"
          value="{{ App\User::NOTIFY_MAIL }}"
          {{ old('notify_trips', Auth::user()->notify_trips) ? 'checked' : '' }}
        >
        {{ __('Путешествия') }}
      </label>
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>
  </form>
</div>
@endsection
