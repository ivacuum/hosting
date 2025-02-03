@extends('dcpp.base')
@include('livewire')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">@lang('Популярные DC++ хабы')</h1>
<div class="grid md:grid-cols-2 gap-8">
  <div>
    @ru
      <p>Итак, вы установили DC++ клиент и, наверное, уже задались вопросом куда подключиться для обмена файлами? Подключиться нужно к хабу, можно даже сразу к нескольким. А выбрать хаб по нраву можно из списка ниже.</p>
    @en
      <p>So you have installed a DC++ client software. The next question is where to connect. To a hub! You can find our top-10 list of DC++ hubs below.</p>
    @endru

    <ol class="mb-4">
      <?php /** @var \App\DcppHub $hub */ ?>
      @foreach ($hubs as $hub)
        <li>
          <a
            class="link js-dcpp-hub"
            href="{{ $hub->externalLink() }}"
            data-action="{{ path(App\Http\Controllers\DcppHubClickController::class, $hub->id) }}"
          >{{ $hub->externalLink() }}</a>
        </li>
      @endforeach
    </ol>

    @ru
      <p>Обычно клика по названию хаба достаточно, чтобы подключиться. Однако если клик не сработал должным образом, то вы можете скопировать адрес и добавить хаб вручную в своем DC++ клиенте.</p>
    @en
      <p>Usually, it is just enough to click a link to connect to a hub. However, if it didn't work for you, you can manually copy-paste the address into your DC++ client.</p>
    @endru

    <div class="font-medium text-2xl mb-2 mt-12 dark:text-white">@lang('Обратная связь')</div>
    @ru
      <p>Знаете хаб, достойный добавления в список? Пришлите его нам, чтобы мы пополнили страницу.</p>
    @en
      <p>Use the form below to send us new hubs or just to tell how to make this page better.</p>
    @endru
    @livewire(App\Livewire\FeedbackForm::class, [
      'title' => 'DC++ Hubs',
      'hideName' => true,
      'hideTitle' => true,
    ])
  </div>
  <div class="lg:w-2/3 xl:w-1/2">
    @include('tpl.google-vertical')
  </div>
</div>
@endsection
