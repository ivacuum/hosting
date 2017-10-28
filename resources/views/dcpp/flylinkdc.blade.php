@extends('dcpp.software', [
  'software_title' => trans('dcpp.flylinkdc'),
  'software' => [
    ['version' => 'r504', 'id' => 153, 'size' => 14172792, 'dl_suffix' => ''],
    ['version' => 'r500', 'id' => 140, 'size' => 17611794, 'dl_suffix' => ''],
  ],
  'developer_site' => 'http://www.flylinkdc.ru/',
])

@section('about_software')
@ru
  <p><strong>FlyLinkDC++</strong> — свободный и открытый клиент сети DC++. Основан на <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>.</p>
  <h3>Основные возможности</h3>
  <div class="row">
    <div class="col-md-3">
      <ul>
        <li>Увеличена скорость закачки распространенных файлов</li>
        <li>Автоподключение уже к добавленным хабам при первом запуске</li>
        <li>Автоматически сохраняет настройки (в случае падения всегда можно будет восстановится)</li>
        <li>Возможность выбора любых ограничений скорости (скорость входящего не зависит от исходящего потока)</li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul>
        <li>Программа автоматически определяет запуск под эмулятором wine (linux) и динамически корректирует свои настройки для исключения «креша»</li>
        <li>При просмотре файл-листа и обнаружении уже имеющегося у Вас файла, будет показано где он хранится</li>
        <li>Улучшено быстродействие</li>
        <li>Имеющиеся у вас файлы подкрашиваются другим цветом</li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul>
        <li>IP фильтрация</li>
        <li>Используется система «Автобан» для запрета скачивания файлов пользователями, не попадающих под заданные критерии</li>
        <li>Новая группа поиска «CD/DVD Image»</li>
        <li>Упрощение процедуры поиска личного IP адреса (возможность вручную указывать скрипт определения)</li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul>
        <li>Добавлен вывод логотипа и название района</li>
        <li>Расширена информация о пользователях</li>
        <li>Можно прикинуться другим клиентом (для тех, кому запрещают использовать FlylinkDC++)</li>
        <li>Новый язык — «Албанский»</li>
      </ul>
    </div>
  </div>

  <h3>Установка и настройка</h3>
  <p>После установки клиента вам необходимо будет указать ваш ник:</p>
  <p><img src="https://img.ivacuum.ru/g/110320/1_hdZWo1DiV3.png" width="670" height="229"></p>
  <p>А также открыть доступ к тем файлам, которыми вы готовы поделиться с другими пользователями:</p>
  <p><img src="https://img.ivacuum.ru/g/110320/1_aVZjr1LGHI.png" width="633" height="443"></p>
  <p>После этих настроек перезапустите программу и пользуйтесь <strong>FlyLinkDC++</strong> с удовольствием!</p>
@en
  <p><strong>FlyLinkDC++</strong> is a free and open-source DC++ client software. It is based on <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>.</p>
@endru
@endsection
