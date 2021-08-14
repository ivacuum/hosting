<?php /** @var App\User $user */ ?>

@extends('my.base')

@section('content')
<h3 class="mb-4">@lang('Настройки')</h3>

<div>
  <form action="@lng/my/settings" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="mb-4">
      <div class="font-bold">@lang('Тема оформления')</div>
      <label class="flex items-center">
        <input
          class="border-gray-300 mr-2"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_LIGHT }}"
          {{ old('theme', $user->theme) == App\User::THEME_LIGHT ? 'checked' : '' }}
        >
        @lang('Светлая (стандартная)')
      </label>
      <label class="flex items-center">
        <input
          class="border-gray-300 mr-2"
          type="radio"
          name="theme"
          value="{{ App\User::THEME_DARK }}"
          {{ old('theme', $user->theme) == App\User::THEME_DARK ? 'checked' : '' }}
        >
        @lang('Темная')
      </label>
      <x-invalid-feedback field="theme"/>
    </div>

    <div class="font-bold">@lang('Торренты')</div>
    <div class="mb-4">
      <input type="hidden" name="torrent_short_title" value="0">
      <label class="flex items-center">
        <input
          class="border-gray-300 rounded mr-2"
          type="checkbox"
          name="torrent_short_title"
          value="1"
          {{ old('torrent_short_title', $user->torrent_short_title) ? 'checked' : '' }}
        >
        @lang('Короткие названия раздач')
      </label>
      <x-invalid-feedback field="torrent_short_title"/>
      @ru
        <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
      @endru
    </div>

    <div class="mb-4">
      <div class="font-bold">@lang('Язык уведомлений')</div>
      @foreach (Arr::sort(array_keys(config('cfg.locales'))) as $loc)
        <label class="flex items-center">
          <input
            class="border-gray-300 mr-2"
            type="radio"
            name="locale"
            value="{{ $loc }}"
            {{ old('locale', $user->locale ?: config('app.locale')) === $loc ? 'checked' : '' }}
          >
          @lang("locale.{$loc}")
        </label>
      @endforeach
      <x-invalid-feedback field="locale"/>
    </div>

    <div class="font-bold">@lang('Уведомления на почту о новых публикациях')</div>
    <input type="hidden" name="notify_gigs" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="border-gray-300 rounded mr-2"
        type="checkbox"
        name="notify_gigs"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_gigs', $user->notify_gigs) ? 'checked' : '' }}
      >
      @lang('Концерты')
    </label>

    <input type="hidden" name="notify_news" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center">
      <input
        class="border-gray-300 rounded mr-2"
        type="checkbox"
        name="notify_news"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('notify_news', $user->notify_news) ? 'checked' : '' }}
      >
      @lang('Новости сайта')
    </label>

    <div class="mb-4">
      <input type="hidden" name="notify_trips" value="{{ App\User::NOTIFY_NO }}">
      <label class="flex items-center">
        <input
          class="border-gray-300 rounded mr-2"
          type="checkbox"
          name="notify_trips"
          value="{{ App\User::NOTIFY_MAIL }}"
          {{ old('notify_trips', $user->notify_trips) ? 'checked' : '' }}
        >
        @lang('Путешествия')
      </label>
    </div>

    <button class="btn btn-primary">
      @lang('Сохранить изменения')
    </button>
  </form>
</div>
@endsection
