@extends('base', [
  'noLanguageSelector' => $locale === 'ru',
])

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">{{ $metaTitle }}</h1>
<div class="max-w-[600px]">
  <p>Хостинг-провайдер Таймвеб регулярно проводит акции для привлечения новых клиентов. Со всеми спецпредложениями всегда можно ознакомиться на их официальном сайте.</p>
  <a class="btn btn-primary" href="https://timeweb.com/ru/services/bonuses/{{ App\Domain\Config::TimewebLink }}">Ознакомиться со всеми акциями</a>
  <div class="form-help">После клика вы будете перемещены на сайт timeweb.com</div>
  <p class="mt-6">Купонов и промокодов у них нет, именно поэтому стоит следить за акциями. Например, Таймвеб регулярно распродает выделенные серверы, дарит хостинг на продолжительное время за покупку лицензий Битрикс, а также дарит и распродает домены со скидкой.</p>

  <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">Размещение и перенос сайта</h2>
  <p>Хотите переехать к Таймвебу? Могу с этим помочь. Связаться со мной можно по <a class="link" href="mailto:timeweb@ivacuum.ru">электронной почте</a>.</p>
</div>
@endsection
