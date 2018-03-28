@extends('my.base')

@section('content')
<h3 class="mb-3">{{ trans('my.settings') }}</h3>

<div class="mw-600">
  <form action="{{ path("$self@update") }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group">
      <label>{{ trans('my.theme') }}</label>
      <label class="form-check">
        <input
          class="form-check-input {{ $errors->has('theme') ? 'is-invalid' : '' }}"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_LIGHT }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}
        >
        <span class="form-check-label">{{ trans('my.theme_light') }}</span>
      </label>
      <label class="form-check">
        <input
          class="form-check-input {{ $errors->has('theme') ? 'is-invalid' : '' }}"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_DARK }}"
          {{ old('theme', Auth::user()->theme) == App\User::THEME_DARK ? 'checked' : '' }}
        >
        <span class="form-check-label">{{ trans('my.theme_dark') }}</span>
      </label>
      @if ($errors->has('theme'))
        <div class="invalid-feedback d-block">{{ $errors->first('theme') }}</div>
      @endif
    </div>

    <label>{{ trans('torrents.index') }}</label>
    <div class="form-group">
      <input type="hidden" name="torrent_short_title" value="0">
      <label class="form-check">
        <input
          class="form-check-input {{ $errors->has('torrent_short_title') ? 'is-invalid' : '' }}"
          type="checkbox"
          name="torrent_short_title"
          value="1"
          {{ old('torrent_short_title', Auth::user()->torrent_short_title) ? 'checked' : '' }}
        >
        <span class="form-check-label">{{ trans('my.torrent_short_title') }}</span>
      </label>
      @if ($errors->has('torrent_short_title'))
        <div class="invalid-feedback d-block">{{ $errors->first('torrent_short_title') }}</div>
      @endif
      @ru
        <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
      @endru
    </div>

    <div class="form-group">
      <label>{{ trans('my.locale') }}</label>
      @foreach (array_sort(array_keys(config('cfg.locales'))) as $loc)
        <label class="form-check">
          <input
            class="form-check-input {{ $errors->has('locale') ? 'is-invalid' : '' }}"
            type="radio"
            name="locale"
            value="{{ $loc }}"
            {{ old('locale', Auth::user()->locale ?: config('app.locale')) === $loc ? 'checked' : '' }}
          >
          <span class="form-check-label">{{ trans("locale.{$loc}") }}</span>
        </label>
      @endforeach
      @if ($errors->has('locale'))
        <div class="invalid-feedback d-block">{{ $errors->first('locale') }}</div>
      @endif
    </div>

    <label>{{ trans('my.mail_subscriptions') }}</label>
    <input type="hidden" name="notify_gigs" value="{{ App\User::NOTIFY_NO }}">
    <label class="form-check">
      <input
        class="form-check-input {{ $errors->has('notify_gigs') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="notify_gigs"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_gigs', Auth::user()->notify_gigs) ? 'checked' : '' }}
      >
      <span class="form-check-label">{{ trans('my.notify_gigs') }}</span>
    </label>
    @if ($errors->has('notify_gigs'))
      <div class="invalid-feedback d-block mb-2">{{ $errors->first('notify_gigs') }}</div>
    @endif

    <input type="hidden" name="notify_news" value="{{ App\User::NOTIFY_NO }}">
    <label class="form-check">
      <input
        class="form-check-input {{ $errors->has('notify_news') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="notify_news"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_news', Auth::user()->notify_news) ? 'checked' : '' }}
      >
      <span class="form-check-label">{{ trans('my.notify_news') }}</span>
    </label>
    @if ($errors->has('notify_news'))
      <div class="invalid-feedback d-block mb-2">{{ $errors->first('notify_news') }}</div>
    @endif

    <div class="form-group">
      <input type="hidden" name="notify_trips" value="{{ App\User::NOTIFY_NO }}">
      <label class="form-check">
        <input
          class="form-check-input {{ $errors->has('notify_trips') ? 'is-invalid' : '' }}"
          type="checkbox"
          name="notify_trips"
          value="{{ App\User::NOTIFY_MAIL }}"
          {{ old('notify_trips', Auth::user()->notify_trips) ? 'checked' : '' }}
        >
        <span class="form-check-label">{{ trans('my.notify_trips') }}</span>
      </label>
      @if ($errors->has('notify_trips'))
        <div class="invalid-feedback d-block mb-2">{{ $errors->first('notify_trips') }}</div>
      @endif
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>

    {{ method_field('put') }}
    {{ csrf_field() }}
  </form>
</div>
@endsection
