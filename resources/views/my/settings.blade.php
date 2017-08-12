@extends('my.base')

@section('content')
<h3 class="mt-2 mb-3">{{ trans('my.settings') }}</h3>

<div class="row">
  <div class="col-md-6">
    <form action="{{ path("$self@update") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}

      <div class="form-group {{ $errors->has('theme') ? 'has-error' : '' }}">
        <label>{{ trans('my.theme') }}</label>
        <div class="radio">
          <label>
            <input type="radio" name="theme" value="{{ App\User::THEME_LIGHT }}" {{ old('theme', Auth::user()->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}>
            {{ trans('my.theme_light') }}
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="theme" value="{{ App\User::THEME_DARK }}" {{ old('theme', Auth::user()->theme) == App\User::THEME_DARK ? 'checked' : '' }}>
            {{ trans('my.theme_dark') }}
          </label>
        </div>
        @if ($errors->has('theme'))
          <span class="help-block">{{ $errors->first('theme') }}</span>
        @endif
      </div>

      <h3 class="mt-5">{{ trans('torrents.index') }}</h3>

      <div class="form-group {{ $errors->has('torrent_short_title') ? 'has-error' : '' }}">
        <div class="checkbox">
          <input type="hidden" name="torrent_short_title" value="0">
          <label>
            <input type="checkbox" name="torrent_short_title" value="1" {{ old('torrent_short_title', Auth::user()->torrent_short_title) ? 'checked' : '' }}>
            {{ trans('my.torrent_short_title') }}
          </label>
        </div>
        @if ($errors->has('torrent_short_title'))
          <span class="help-block">{{ $errors->first('torrent_short_title') }}</span>
        @endif
        @ru
          <span class="help-block">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</span>
        @endlang
      </div>

      <button type="submit" class="btn btn-primary">
        {{ trans('my.save') }}
      </button>

      {{ method_field('put') }}
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
