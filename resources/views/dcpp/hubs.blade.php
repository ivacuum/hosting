@extends('dcpp.base')

@section('content')
<h1>{{ trans('meta_title.dcpp.hubs') }}</h1>
<div class="md:flex md:-mx-4">
  <div class="md:w-1/2 md:px-4">
    @ru
      <p>Итак, вы установили DC++ клиент и, наверное, уже задались вопросом куда же подключиться для обмена файлами? Подключиться нужно к хабу, можно даже сразу к нескольким. А выбрать хаб по нраву можно из списка ниже.</p>
    @en
      <p>So you have installed a DC++ client software. The next question is where to connect. To a hub! You can find our top-10 list of DC++ hubs below.</p>
    @endru

    <ol>
      @foreach ($hubs as $hub)
        <li>
          <a
            class="link js-dcpp-hub"
            href="{{ $hub->externalLink() }}"
            data-action="{{ path('DcppHubClick@store', $hub->id) }}"
          >{{ $hub->externalLink() }}</a>
        </li>
      @endforeach
    </ol>

    @ru
      <p>Обычно клика по названию хаба достаточно, чтобы подключиться. Однако, если клик не сработал должным образом, то вы можете скопировать адрес и добавить хаб вручную в своем DC++ клиенте.</p>
    @en
      <p>Usually, it is just enough to click a link to connect to a hub. However, if it didn't work for you, you can manually copy-paste the address into your DC++ client.</p>
    @endru

    <div class="h3 mt-12">{{ trans('issues.create') }}</div>
    @ru
      <p>Знаете хаб, достойный добавления в список? Пришлите его нам, чтобы мы пополнили страницу.</p>
    @en
      <p>Use the form below to send us new hubs or just to tell how to make this page better.</p>
    @endru
    <feedback-form
      email="{{ Auth::user()->email ?? '' }}"
      title="DC++ Hubs"
      action="{{ path('Issues@store') }}"
      hide-name
      hide-title
    ></feedback-form>
  </div>
  <div class="md:w-1/2 lg:w-1/3 xl:w-1/4 md:px-4 mt-4 md:mt-0">
    @include('tpl.google-vertical')
  </div>
</div>
@endsection
