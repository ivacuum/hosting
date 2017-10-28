@extends('dcpp.base', [
  'no_language_selector' => $locale === 'ru',
])

@section('content')
@ru
  <h1 class="mt-0">Инструкция по русификации</h1>
  <p>
    <a class="btn btn-primary mr-2" href="{{ path('Files@download', 157) }}">
      Файл русификации ApexDC++ &middot; {{ ViewHelper::size(21464) }}
    </a>
    <a class="btn btn-primary" href="{{ path('Files@download', 28) }}">
      Файл русификации GreyLinkDC++ &middot; {{ ViewHelper::size(108876) }}
    </a>
  </p>

  <h2 class="mt-5">Как русифицировать клиент</h2>
  <ol>
    <li>Установите и запустите программу.</li>
    <li>
      <p>Если перед вами не откроется окно с настройками, откройте «File — Settings».</p>
      <p><img src="https://img.ivacuum.ru/g/091002/1_LEcAuwMxCr.gif" width="661" height="499"></p>
    </li>
    <li>Найдите слева, в дереве навигации, вкладку «<strong>Appearance</strong>». Найдите справа внизу кнопку «<strong>Browse...</strong>» и нажмите на нее.</li>
    <li>
      <p>Перед вами откроется окно с выбором пути к файлы русификации «<strong>Russian.xml</strong>». В моем случае он лежит в папке с клиентом, вам я рекомендую сделать также.</p>
      <p><img src="https://img.ivacuum.ru/g/091002/1_1M7VcFUbBe.gif" width="561" height="415"></p>
    </li>
    <li>Укажите в этом окне файл русификации и нажмите «<strong>Открыть</strong>».</li>
    <li>
      <p>После этого нажмите «<strong>ОК</strong>».</p>
      <p><img src="https://img.ivacuum.ru/g/091002/1_D7OwjJUgBu.gif" width="661" height="499"></p>
    </li>
    <li>Перезагрузите программу.</li>
    <li>
      <p>Если вы увидите, что все пункты меню стали русскими, как на рисунке — значит вы все сделали верно.</p>
      <p><img src="https://img.ivacuum.ru/g/091002/1_06xcHm1YXB.gif" width="661" height="499"></p>
    </li>
  </ol>
@endru
@endsection
