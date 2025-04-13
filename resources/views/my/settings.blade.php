<?php /** @var App\User $user */ ?>

@extends('my.base')

@section('content')
<h3 class="font-medium text-2xl mb-4">@lang('Настройки')</h3>

<div>
  <form action="@lng/my/settings" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    @method('put')
    @csrf

    <div class="grid gap-6">
      <div>
        <div class="font-bold">@lang('Магнеты')</div>
          <input type="hidden" name="magnet_short_title" value="0">
          <label class="flex gap-2 items-center">
            <input
              class="not-checked:border-gray-300 text-sky-600 rounded-sm"
              type="checkbox"
              name="magnet_short_title"
              value="1"
              {{ old('magnet_short_title', $user->magnet_short_title) ? 'checked' : '' }}
            >
            @lang('Короткие названия раздач')
          </label>
          <x-invalid-feedback field="magnet_short_title"/>
          @ru
            <div class="form-help">Из названий раздач будут скрыты данные в скобках, например, Deus Ex <s>[RePack] [RUS] (2007)</s>.</div>
          @endru
      </div>

      <div>
        <div class="font-bold">@lang('Язык уведомлений')</div>
        @foreach (Arr::sort(array_keys(App\Domain\Config::Locales->get())) as $loc)
          <label class="flex gap-2 items-center">
            <input
              class="not-checked:border-gray-300 text-sky-600"
              type="radio"
              name="locale"
              value="{{ $loc }}"
              {{ old('locale', $user->locale ?: App\Domain\Config::Locale->get()) === $loc ? 'checked' : '' }}
            >
            @lang("locale.{$loc}")
          </label>
        @endforeach
        <x-invalid-feedback field="locale"/>
      </div>

      @if($user->isRoot())
        <div>
          <div class="font-bold">@lang('Способ доставки уведомлений')</div>
          <label class="flex gap-2 items-center">
            <input
              class="not-checked:border-gray-300 text-sky-600"
              type="radio"
              name="notification_delivery_method"
              value="0"
              {{ old('notification_delivery_method', $user->notification_delivery_method->isDisabled()) ? 'checked' : '' }}
            >
            @lang("Не уведомлять")
          </label>
          <label class="flex gap-2 items-center">
            <input
              class="not-checked:border-gray-300 text-sky-600"
              type="radio"
              name="notification_delivery_method"
              value="1"
              {{ old('notification_delivery_method', $user->notification_delivery_method->isMail()) ? 'checked' : '' }}
            >
            @lang("Электронная почта")
          </label>
            <label class="flex gap-2 items-center">
              <input
                disabled
                class="not-checked:border-gray-300 text-sky-600"
                type="radio"
                name="notification_delivery_method"
                value="2"
                {{ old('notification_delivery_method', $user->notification_delivery_method->isTelegram()) ? 'checked' : '' }}
              >
              @if($user->telegram_id)
                @lang("Телеграм")
              @else
                <span class="line-through text-gray-500">@lang('Телеграм')</span>
              @endif
            </label>
          <x-invalid-feedback field="notification_delivery_method"/>
        </div>
      @endif

      <div>
        <div class="font-bold">@lang('Уведомления о новых публикациях')</div>
        <input type="hidden" name="notify_gigs" value="{{ App\Domain\NotificationDeliveryMethod::Disabled }}">
        <label class="flex gap-2 items-center">
          <input
            class="not-checked:border-gray-300 text-sky-600 rounded-sm"
            type="checkbox"
            name="notify_gigs"
            value="{{ App\Domain\NotificationDeliveryMethod::Mail }}"
            {{ old('notify_gigs', $user->notify_gigs->isEnabled()) ? 'checked' : '' }}
          >
          @lang('Концерты')
        </label>

        <input type="hidden" name="notify_news" value="{{ App\Domain\NotificationDeliveryMethod::Disabled }}">
        <label class="flex gap-2 items-center">
          <input
            class="not-checked:border-gray-300 text-sky-600 rounded-sm"
            type="checkbox"
            name="notify_news"
            value="{{ App\Domain\NotificationDeliveryMethod::Mail }}"
            {{ old('notify_news', $user->notify_news->isEnabled()) ? 'checked' : '' }}
          >
          @lang('Новости сайта')
        </label>

        <div class="mb-4">
          <input type="hidden" name="notify_trips" value="{{ App\Domain\NotificationDeliveryMethod::Disabled }}">
          <label class="flex gap-2 items-center">
            <input
              class="not-checked:border-gray-300 text-sky-600 rounded-sm"
              type="checkbox"
              name="notify_trips"
              value="{{ App\Domain\NotificationDeliveryMethod::Mail }}"
              {{ old('notify_trips', $user->notify_trips->isEnabled()) ? 'checked' : '' }}
            >
            @lang('Путешествия')
          </label>
        </div>
      </div>
    </div>

    <button class="btn btn-primary">
      @lang('Сохранить изменения')
    </button>
  </form>

  @if($user->isRoot())
    <div class="mt-12">
      <h3 class="font-medium text-2xl mb-2">@lang('Уведомления в Телеграм')</h3>
      @if($user->telegram_id)
        @ru
          <p>Вы сообщили нам свой аккаунт, чтобы получать уведомления в Телеграм.</p>
        @en
          <p>You have successfully linked your Telegram account to receive site notifications.</p>
        @endru
        <div><a class="btn btn-default" href="{{ to('my/unlink-telegram') }}">@lang('Отвязать аккаунт')</a></div>
      @else
        @ru
          <p>Уведомления с сайта можно получать в Телеграм. Начните диалог с нашим ботом, чтобы мы поняли на какой аккаунт отправлять вам уведомления. Бот сообщит об успешной привязке.</p>
        @en
          <p>Site notifications can be sent to Telegram. Start a conversation with our bot so we can understand which account to send notifications to.</p>
        @endru
        <div><a class="btn btn-default" href="{{ to('my/link-telegram') }}">@lang('Открыть Телеграм')</a></div>
      @endif
    </div>
  @endif
</div>
@endsection
