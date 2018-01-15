@extends('my.base')

@section('content')
<h3 class="mb-3">{{ trans('my.settings') }}</h3>

<div class="mw-600">
  <form action="{{ path("$self@update") }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="form-group">
      <label>{{ trans('my.theme') }}</label>
      <label class="form-check">
        <input class="form-check-input" type="radio" name="theme" value="{{ App\User::THEME_LIGHT }}" {{ old('theme', Auth::user()->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}>
        {{ trans('my.theme_light') }}
      </label>
      <label class="form-check">
        <input class="form-check-input" type="radio" name="theme" value="{{ App\User::THEME_DARK }}" {{ old('theme', Auth::user()->theme) == App\User::THEME_DARK ? 'checked' : '' }}>
        {{ trans('my.theme_dark') }}
      </label>
      @if ($errors->has('theme'))
        <div class="form-help">{{ $errors->first('theme') }}</div>
      @endif
    </div>

    <label>{{ trans('torrents.index') }}</label>
    <div class="form-group">
      <input type="hidden" name="torrent_short_title" value="0">
      <label class="form-check">
        <input class="form-check-input {{ $errors->has('torrent_short_title') ? 'is-invalid' : '' }}" type="checkbox" name="torrent_short_title" value="1" {{ old('torrent_short_title', Auth::user()->torrent_short_title) ? 'checked' : '' }}>
        <span class="form-check-label">{{ trans('my.torrent_short_title') }}</span>
      </label>
      @if ($errors->has('torrent_short_title'))
        <div class="invalid-feedback d-block">{{ $errors->first('torrent_short_title') }}</div>
      @endif
      @ru
        <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
      @endru
    </div>

    <button class="btn btn-primary">
      {{ trans('my.save') }}
    </button>

    {{ method_field('put') }}
    {{ csrf_field() }}
  </form>
</div>
@endsection
