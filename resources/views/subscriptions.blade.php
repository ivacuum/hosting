@extends('base')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">@lang('Уведомления на почту о новых публикациях')</h1>
<div class="antialiased hanging-punctuation-first lg:text-lg">
  @ru
    <p>Хотите узнавать о новых историях о путешествиях, отчетах о посещенных концертах и новостях сайта сразу после их публикации? Тогда подпишитесь на уведомления с помощью формы ниже.</p>
  @endru
  <form class="max-w-[400px] mb-6" action="@lng/subscriptions" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="mb-4">
      <input
        required
        class="form-input"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="@lang('model.email')"
      >
      <x-invalid-feedback field="email"/>
    </div>

    <input type="hidden" name="gigs" value="{{ App\Domain\NotificationDeliveryMethod::Disabled->value }}">
    <label class="flex gap-2 items-center">
      <input
        class="border-gray-300 rounded"
        type="checkbox"
        name="gigs"
        value="{{ App\Domain\NotificationDeliveryMethod::Mail->value }}"
        {{ old('gigs', request('gigs')) ? 'checked' : '' }}
      >
      @lang('Концерты')
    </label>

    <input type="hidden" name="news" value="{{ App\Domain\NotificationDeliveryMethod::Disabled->value }}">
    <label class="flex gap-2 items-center">
      <input
        class="border-gray-300 rounded"
        type="checkbox"
        name="news"
        value="{{ App\Domain\NotificationDeliveryMethod::Mail->value }}"
        {{ old('news', request('news')) ? 'checked' : '' }}
      >
      @lang('Новости сайта')
    </label>

    <div class="mb-4">
      <input type="hidden" name="trips" value="{{ App\Domain\NotificationDeliveryMethod::Disabled->value }}">
      <label class="flex gap-2 items-center">
        <input
          class="border-gray-300 rounded"
          type="checkbox"
          name="trips"
          value="{{ App\Domain\NotificationDeliveryMethod::Mail->value }}"
          {{ old('trips', request('trips')) ? 'checked' : '' }}
        >
        @lang('Путешествия')
      </label>
    </div>

    <button class="btn btn-primary capitalize">
      @lang('mail.subscribe')
    </button>

    @csrf
  </form>
  @ru
    <p><a class="link" href="/life/gigs">Истории о концертах</a> появляются всего несколько раз в год — по числу посещенных шоу. Количество <a class="link" href="/life">заметок о путешествиях</a> может доходить и до 50 в год, то есть в среднем это одна публикация в неделю. Иногда бывают пики до трех публикаций в неделю после насыщенных поездок. <a class="link" href="/news">Новости сайта</a> в среднем публикуются раз в месяц с историей обновлений за прошедший период. Иногда в новостях публикуются материалы о полезных сервисах и разные мысли.</p>
    <p>После отправки формы вы получите письмо со ссылкой на подтверждение желания получать письма-уведомления. В дальнейшем каждая рассылка будет содержать ссылку на управление настройками подписки — отписаться можно будет буквально в несколько кликов.</p>
  @endru

  <h3 class="font-medium text-2xl mt-12 mb-2">RSS</h3>
  <div class="mb-1">
    @ru
      В качестве альтернативы все перечисленные уведомления можно получать через RSS.
    @en
      As an alternative you can subscribe to RSS feeds.
    @endru
  </div>
  <div class="flex flex-wrap gap-4 items-center">
    <a
      class="text-lg svg-flex svg-label lowercase small-caps"
      href="@lng/life/gigs/rss"
    >
      @svg (rss-square)
      @lang('Концерты')
    </a>
    <a
      class="text-lg svg-flex svg-label lowercase small-caps"
      href="@lng/news/rss"
    >
      @svg (rss-square)
      @lang('Новости сайта')
    </a>
    <a
      class="text-lg svg-flex svg-label lowercase small-caps"
      href="@lng/life/rss"
    >
      @svg (rss-square)
      @lang('Путешествия')
    </a>
  </div>
</div>
@endsection
