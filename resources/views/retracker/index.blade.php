@extends('retracker.base')

@section('content')
<section class="pt-3 pb-5">
  <div class="container mw-800">
    <div class="text-center mb-3">
      <a href="{{ path('Retracker@index') }}">
        <img src="https://ivacuum.org/i/rt/logo.png" width="64" height="64">
      </a>
    </div>
    <h1 class="h2">Что такое ретрекер?</h1>
    <p><strong>Ретрекер</strong> — анонимный локальный трекер. Использование ретрекера позволяет пирам обмениваться трафиком на повышенной скорости, используя внутреннюю адресацию локальной сети провайдера, так как доступ к локальной сети разрешен на более высокой скорости, нежели доступ в интернет. Кроме того, использование ретрекера снижает нагрузку на магистральные каналы связи за счет того, что абонентам не нужно скачивать по отдельности одни и те же данные.</p>
    <p>По информации с сайта <a class="link" href="https://ru.wikipedia.org/wiki/Ретрекер">wikipedia.org</a>.</p>

    <div>
      <a class="btn btn-default" href="{{ path('Files@download', 122) }}">
        Скачать исходный код ретрекера
      </a>
    </div>
  </div>
</section>

<section class="bg-light border-top border-bottom py-5">
  <div class="container mw-800">
    <h3>Зачем он нужен?</h3>
    <ul class="tw-mb-0">
      <li>для совместной закачки файлов из интернета;</li>
      <li>появляется возможность скачать раздачу на локальной скорости, если раздающие тоже пользуются ретрекером.</li>
    </ul>
  </div>
</section>

<section class="py-5">
  <div class="container mw-800">
    <h3>Как настроить?</h3>
    <p>Использование ретрекера по адресу <b>retracker.local</b> требует дополнительной настройки.</p>
    <p><a class="btn btn-primary my-1" href="{{ path('Files@download', 123) }}">Файл настроек для Windows</a> <a class="btn btn-primary my-1" href="{{ path('Files@download', 124) }}">Файл настроек для Linux</a></p>
    <p>Пользователям ОС Windows достаточно сохранить и запустить файл настроек от имени администратора.</p>
    <p>Пользователям ОС семейства Linux необходимо либо запустить файл настроек от имени администратора, либо набрать в терминале следующие команды:</p>
    <pre>wget https://ivacuum.org/d/rt/retracker.local.sh
chmod +x ./retracker.local.sh
sudo ./retracker.local.sh</pre>
    <div>После завершения настройки необходимо подождать около 15 минут, либо перезапустить торрент-клиент.</div>
  </div>
</section>

<section class="bg-light border-top py-5">
  <div class="container mw-800">
    <h3>Как понять, что ретрекер заработал?</h3>
    <p>Статус трекера «retracker.local» в вашем торрент-клиент на вкладке «Трекеры» (Trackers) должен измениться на «работает» (working) как на картинке ниже:</p>
    <div><img class="img-fluid" src="https://img.ivacuum.ru/g/100710/1_899GTp1JNl.png"></div>
  </div>
</section>
@endsection
