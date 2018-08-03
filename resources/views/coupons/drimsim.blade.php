@extends('base', [
  'no_language_selector' => $locale === 'ru',
])

@section('content')
<h1>{{ $meta_title }}</h1>
<div class="mw-600">
  @ru
    <p>Если вы только собираетесь заказать симку, то по ссылке ниже можно получить дополнительные 5 евро на счет при первом пополнении баланса.</p>
    <a class="btn btn-primary" href="{{ config('cfg.drimsim_link') }}">Заказать симку с бонусом в 5 евро</a>
    <div class="form-help">После клика вы будете перемещены на сайт drimsim.com</div>

    <p class="mt-4"><strong>Как это работает без перехода по ссылке</strong>. Вы заказываете симку за 10 евро (доставка включена), затем пополняете баланс на 10 евро. В итоге у вас на счету 10 евро.</p>
    <p><strong>С переходом по ссылке.</strong> Вы все так же заказываете симку за 10 евро с включенной доставкой и после ее получения пополняете ее на 10 евро. Но в этот раз итоговый баланс у вас будет 15 евро.</p>

    <h2 class="mt-5">Чем хорош Дримсим?</h2>
    <div>Этому вопросу посвящена <a class="link" href="/news/271">отдельная страница</a>.</div>
  @en
    <a class="btn btn-primary" href="{{ config('cfg.drimsim_link') }}">Get SIM card with extra €5</a>
    <div class="form-help">After a click you will be redirected to drimsim.com</div>
  @endru
</div>
@endsection
