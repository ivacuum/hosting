@extends('base')

@section('content')
<h1 class="text-2xl">{{ trans('my.mail_subscriptions') }}</h1>
<div class="antialiased hanging-puntuation-first lg:text-lg">
  @ru
    <p>Хотите узнавать о новых историях о путешествиях, отчетах о посещенных концертах и новостях сайта сразу после их публикации? Тогда подпишитесь на уведомления с помощью формы ниже.</p>
  @endru
  <form class="max-w-400px mb-6" action="{{ path('Subscriptions@store') }}" method="post">
    {{ ViewHelper::inputHiddenMail() }}

    <div class="mb-4">
      <input
        required
        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="{{ trans('model.email') }}"
      >
      @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
      @endif
    </div>

    <input type="hidden" name="gigs" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center font-normal">
      <input
        class="mr-2 {{ $errors->has('gigs') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="gigs"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('gigs', request('gigs')) ? 'checked' : '' }}
      >
      {{ trans('my.notify_gigs') }}
    </label>
    @if ($errors->has('gigs'))
      <div class="invalid-feedback block mb-2">{{ $errors->first('gigs') }}</div>
    @endif

    <input type="hidden" name="news" value="{{ App\User::NOTIFY_NO }}">
    <label class="flex items-center font-normal">
      <input
        class="mr-2 {{ $errors->has('news') ? 'is-invalid' : '' }}"
        type="checkbox"
        name="news"
        value="{{ App\User::NOTIFY_MAIL }}"
        {{ old('news', request('news')) ? 'checked' : '' }}
      >
      {{ trans('my.notify_news') }}
    </label>
    @if ($errors->has('news'))
      <div class="invalid-feedback block mb-2">{{ $errors->first('news') }}</div>
    @endif

    <div class="mb-4">
      <input type="hidden" name="trips" value="{{ App\User::NOTIFY_NO }}">
      <label class="flex items-center font-normal">
        <input
          class="mr-2 {{ $errors->has('trips') ? 'is-invalid' : '' }}"
          type="checkbox"
          name="trips"
          value="{{ App\User::NOTIFY_MAIL }}"
          {{ old('trips', request('trips')) ? 'checked' : '' }}
        >
        {{ trans('my.notify_trips') }}
      </label>
      @if ($errors->has('trips'))
        <div class="invalid-feedback block mb-2">{{ $errors->first('trips') }}</div>
      @endif
    </div>

    <button class="btn btn-primary capitalize">
      {{ trans('mail.subscribe') }}
    </button>

    @csrf
  </form>
  @ru
    <p><a class="link" href="{{ path('Life@gigs') }}">Истории о концертах</a> появляются всего несколько раз в год — по числу посещенных шоу. Количество <a class="link" href="{{ path('Life@index') }}">заметок о путешествиях</a> может доходить и до 50 в год, то есть в среднем это одна публикация в неделю. Иногда бывают пики до трех публикаций в неделю после насыщенных поездок. <a class="link" href="{{ path('News@index') }}">Новости сайта</a> в среднем публикуются раз в месяц с историей обновлений за прошедший период. Иногда в новостях публикуются материалы о полезных сервисах и разные мысли.</p>
    <p>После отправки формы вы получите письмо со ссылкой на подтверждение желания получать письма-уведомления. В дальнейшем каждая рассылка будет содержать ссылку на управление настройками подписки — отписаться можно будет буквально в несколько кликов.</p>
  @endru

  <h3 class="mt-12">RSS</h3>
  @ru
    <div class="mb-1">В качестве альтернативы все перечисленные уведомления можно получать через RSS.</div>
  @en
    <div class="mb-1">As an alternative you can subscribe to RSS feeds.</div>
  @endru
  <div class="flex items-center flex-wrap">
    <a class="text-lg svg-flex svg-label small-caps mr-4" href="{{ path('LifeGigsRss@index') }}">
      @svg (rss-square)
      {{ mb_strtolower(trans('my.notify_gigs')) }}
    </a>
    <a class="text-lg svg-flex svg-label small-caps mr-4" href="{{ path('NewsRss@index') }}">
      @svg (rss-square)
      {{ mb_strtolower(trans('my.notify_news')) }}
    </a>
    <a class="text-lg svg-flex svg-label small-caps" href="{{ path('LifeTripsRss@index') }}">
      @svg (rss-square)
      {{ mb_strtolower(trans('my.notify_trips')) }}
    </a>
  </div>
</div>
@endsection
