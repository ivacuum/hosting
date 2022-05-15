@extends('base', [
  'noLanguageSelector' => $locale === 'ru',
])
@include('livewire')

@section('content')
<h1>{{ $metaTitle }}</h1>
<div class="max-w-[600px]">
  @ru
    <p>Если вы только собираетесь заказать симку, то по ссылке ниже можно получить дополнительные 7&nbsp;евро на счет при первом пополнении баланса.</p>
    <a class="btn btn-primary" href="{{ config('cfg.drimsim_link') }}">Заказать симку с бонусом в 7&nbsp;евро</a>
    <div class="form-help">После клика вы будете перемещены на сайт drimsim.com</div>

    <p class="mt-6"><strong>Как это работает без перехода по ссылке</strong>. Вы заказываете симку за 10&nbsp;евро (доставка включена), затем пополняете баланс на минимальную сумму 25&nbsp;евро. В итоге у вас на счету 25&nbsp;евро.</p>
    <p><strong>С переходом по ссылке.</strong> Вы все так же заказываете симку за 10&nbsp;евро с включенной доставкой и после ее получения пополняете ее на 25&nbsp;евро. Но в этот раз итоговый баланс у вас будет 32&nbsp;евро.</p>

    {{--
    <h2 class="mt-12">Промокоды</h2>
    <p>По коду <strong>vinskiy</strong> к заказу первой симки будет применена скидка 20%. Не забудьте перейти по ссылке выше для получения дополнительного бонуса в 5&nbsp;евро при первом пополнении баланса.</p>
    --}}

    <h2 class="mt-12">Чем хорош Дримсим?</h2>
    <div>Этому вопросу посвящена <a class="link" href="/news/271">отдельная страница</a>.</div>
  @en
    <a class="btn btn-primary" href="{{ config('cfg.drimsim_link') }}">Get SIM card with extra €7</a>
    <div class="form-help">After a click you will be redirected to drimsim.com</div>
  @endru

  <section class="mt-12">
    <div class="h3">@lang('Обратная связь')</div>
    @ru
      <p>Знаете промокод или другие способы сэкономить на услугах Дримсима? Хотите оставить отзыв или задать вопрос? Используйте форму ниже, чтобы поделиться с нами информацией. По возможности мы дополним эту страницу новыми материалами.</p>
    @en
      <p>Use the form below to ask a question or just to tell us how to make this page better. New coupons and ways to cut down the expenses are welcome.</p>
    @endru
    @livewire(App\Http\Livewire\FeedbackForm::class, [
      'title' => 'Drimsim',
      'hideTitle' => true,
    ])
  </section>
</div>
@endsection
