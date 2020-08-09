@extends('life.base')

@section('content')
<h1 class="h2">@lang('Подкасты')</h1>
<p>Ссылки на любимые передачи и их отдельные выпуски.</p>

<section>
  <h3>Брендятина</h3>
  <p>Истории брендов. Послушать можно в <a href="https://itunes.apple.com/ru/podcast/brendatina-istorii-brendov/id510731338?mt=2" class="link">iTunes</a> или <a href="http://brand.podfm.ru/" class="link">podfm.ru</a>.</p>
  <div class="mb-1">Любимые выпуски:</div>
  <ul>
    <li>
      <a class="link" href="https://brand.podfm.ru/1270/">Twitter</a>
      <span class="text-xs text-muted">#243</span>
    </li>
    <li>
      <a class="link" href="https://brand.podfm.ru/782/">Туполев</a>
      <span class="text-xs text-muted">#204</span>
    </li>
    <li>
      <a class="link" href="https://brand.podfm.ru/102/">FedEx</a>
      <span class="text-xs text-muted">#102</span>
    </li>
  </ul>
</section>
@endsection
