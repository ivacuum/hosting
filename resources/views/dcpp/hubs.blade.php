@extends('dcpp.base')

@section('content')
<h1>{{ trans('meta_title.dcpp.hubs') }}</h1>
<div class="row">
  <div class="col-md-6">
    @ru
      <p>Итак, вы установили DC++ клиент и, наверное, уже задались вопросом куда же подключиться для обмена файлами? Подключиться нужно к хабу, можно даже сразу к нескольким. А выбрать хаб по нраву можно из списка ниже.</p>
    @en
      <p>So you have installed a DC++ client software. The next question is where to connect. To a hub! You can find our top-10 list of DC++ hubs below.</p>
    @endru
  </div>
</div>

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

<div class="row">
  <div class="col-md-6">
    @ru
      <p>Обычно клика по названию хаба достаточно, чтобы подключиться. Однако, если клик не сработал должным образом, то вы можете скопировать адрес и добавить хаб вручную в своем DC++ клиенте.</p>
    @en
      <p>Usually, it is just enough to click a link to connect to a hub. However, if it didn't work for you, you can manually copy-paste the address into your DC++ client.</p>
    @endru
  </div>
</div>
@endsection
