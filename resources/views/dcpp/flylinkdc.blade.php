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
  <p><strong>FlyLinkDC++</strong> — свободный и открытый клиент сети DC++. Основан на <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>. Русский язык входит в стандартный комплект поставки. Инсталлятор включает в себя как 32-битную версию, так и 64.</p>

  <h3 class="tw-mt-12">Установка и настройка</h3>
  <p>После установки клиента вам необходимо будет указать ваш ник:</p>
  <p><img class="img-fluid" src="https://img.ivacuum.ru/g/110320/1_hdZWo1DiV3.png" width="670" height="229"></p>
  <p>А также открыть доступ к тем файлам, которыми вы готовы поделиться с другими пользователями:</p>
  <p><img class="img-fluid" src="https://img.ivacuum.ru/g/110320/1_aVZjr1LGHI.png" width="633" height="443"></p>
  <p>После этих настроек перезапустите программу и пользуйтесь <strong>FlyLinkDC++</strong> с удовольствием!</p>
@en
  <p><strong>FlyLinkDC++</strong> is a free and open-source DC++ client software. It is based on <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>. Installer has both 32-bit and 64-bit versions of the client in it.</p>
@endru
@endsection

@section('software_features')
<section class="tw-my-0 py-5">
  <div class="tw-container">
    <h3>
      @ru
        Основные возможности FlyLinkDC++
      @en
        Main features of FlyLinkDC++
      @endru
    </h3>
    <div class="row">
      <div class="col-md">
        <ul>
          @ru
            <li>Увеличена скорость закачки распространенных файлов</li>
            <li>Автоподключение уже к добавленным хабам при первом запуске</li>
            <li>Автоматическое сохранение настроек — в случае падения всегда можно будет восстановиться</li>
            <li>Возможность выбора любых ограничений скорости (скорость входящего потока не зависит от исходящего)</li>
            <li>Программа автоматически определяет запуск под эмулятором @svg (linux) wine и динамически корректирует свои настройки для исключения падения</li>
            <li>При просмотре файл-листа и обнаружении уже имеющегося у вас файла, будет показано где он хранится</li>
            <li>Имеющиеся у вас файлы подкрашиваются другим цветом</li>
            <li>Автоматическое обновление программы и ее компонентов</li>
          @en
            <li>Popular files are downloaded faster.</li>
            <li>Files you have are colored differently.</li>
            <li>Automatic update of the client and its components.</li>
          @endru
        </ul>
      </div>
      <div class="col-md">
        <ul>
          @ru
            <li>Фильтрация по IP-адресу, чтобы качать только из бесплатной локальной сети</li>
            <li>Используется система «Автобан» для запрета скачивания файлов пользователями, не попадающих под заданные критерии</li>
            <li>Новая группа поиска «CD/DVD Image»</li>
            <li>Упрощена процедура поиска личного IP-адреса (возможность вручную указывать скрипт определения)</li>
            <li>Добавлен вывод логотипа и название района города</li>
            <li>Расширена информация о пользователях</li>
            <li>Можно прикинуться другим клиентом — актуально для тех, кому запрещают использовать FlylinkDC++</li>
            <li>Поддержка технологии DHT для работы без хаба</li>
          @en
            <li>IP-filter to restrict traffic to only local (and free) network.</li>
            <li>More info about users.</li>
            <li>DHT support, so there is no need in hubs.</li>
          @endru
        </ul>
      </div>
    </div>
  </div>
</section>
@endsection
