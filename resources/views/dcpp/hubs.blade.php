@extends('dcpp.base')

@section('content')
<h1 class="mt-0">{{ trans('dcpp.hubs') }}</h1>
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
      <a class="link js-dcpp-hub"
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
    @endru
  </div>
</div>

<ol>
  <li><a class="link js-dcpp-hub" href="dchub://novosibirsk-forever.ru" data-action="{{ path('DcppHubClick@store', 1) }}">dchub://novosibirsk-forever.ru</a></li>
  <li><a class="link" href="dchub://dc.milenahub.ru">dchub://dc.milenahub.ru</a></li>
  <li><a class="link" href="dchub://allavtovo.ru">dchub://allavtovo.ru</a></li>
  <li><a class="link" href="dchub://dc.tiera.ru">dchub://dc.tiera.ru</a></li>
  <li><a class="link" href="dchub://dc.fly-server.ru">dchub://dc.fly-server.ru</a></li>
  <li><a class="link" href="dchub://dc.filimania.com">dchub://dc.filimania.com</a></li>
  <li><a class="link" href="dchub://favorite-hub.net">dchub://favorite-hub.net</a></li>
  <li><a class="link" href="dchub://piknik-dc.ru">dchub://piknik-dc.ru</a></li>
  <li><a class="link" href="dchub://dc.rutrack.net">dchub://dc.rutrack.net</a></li>
  <li><a class="link" href="dchub://stealthhub.ru">dchub://stealthhub.ru</a></li>
</ol>
@endsection
