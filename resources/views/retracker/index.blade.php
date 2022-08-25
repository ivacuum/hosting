@extends('retracker.base')

@section('content')
<section class="pt-4 pb-12">
  <div class="container lg:max-w-3xl">
    <div class="text-center mb-4">
      <a href="@lng/retracker">
        <img class="w-16 h-16" src="https://ivacuum.org/i/rt/logo.png" alt="">
      </a>
    </div>
    <h1 class="font-medium text-3xl tracking-tight mb-2">Что такое ретрекер?</h1>
    <p><strong>Ретрекер</strong> — анонимный локальный трекер. Использование ретрекера позволяет пирам обмениваться трафиком на повышенной скорости, используя внутреннюю адресацию локальной сети провайдера, так как доступ к локальной сети разрешен на более высокой скорости, нежели доступ в интернет. Кроме того, использование ретрекера снижает нагрузку на магистральные каналы связи за счет того, что абонентам не нужно скачивать по отдельности одни и те же данные.</p>
    <p>По информации с сайта <a class="link" href="https://ru.wikipedia.org/wiki/Ретрекер">wikipedia.org</a>.</p>

    <div>
      <a class="btn btn-default" href="@lng/files/122/dl">
        Скачать исходный код ретрекера
      </a>
    </div>
  </div>
</section>

<section class="bg-light dark:bg-slate-800 border-t border-b border-grey-200 dark:border-slate-700 py-12">
  <div class="container lg:max-w-3xl">
    <h3 class="font-medium text-2xl mb-2">Зачем он нужен?</h3>
    <ul>
      <li>для совместной закачки файлов из интернета;</li>
      <li>появляется возможность скачать раздачу на локальной скорости, если раздающие тоже пользуются ретрекером.</li>
    </ul>
  </div>
</section>

<section class="py-12">
  <div class="container lg:max-w-3xl">
    <h3 class="font-medium text-2xl mb-2">Как настроить?</h3>
    <p>Использование ретрекера по адресу <b>retracker.local</b> требует дополнительной настройки.</p>
    <p><a class="btn btn-primary my-1" href="@lng/files/123/dl">Файл настроек для Windows</a> <a class="btn btn-primary my-1" href="@lng/files/124/dl">Файл настроек для Linux</a></p>
    <p>Пользователям ОС Windows достаточно сохранить и запустить файл настроек от имени администратора.</p>
    <p>Пользователям ОС семейства Linux необходимо либо запустить файл настроек от имени администратора, либо набрать в терминале следующие команды:</p>
    <pre class="mb-4 text-sm bg-light dark:bg-slate-800 border dark:border-slate-700 p-2 rounded whitespace-pre-wrap">wget https://ivacuum.org/d/rt/retracker.local.sh
chmod +x ./retracker.local.sh
sudo ./retracker.local.sh</pre>
    <div>После завершения настройки необходимо подождать около 15 минут, либо перезапустить торрент-клиент.</div>
  </div>
</section>

<section class="bg-light dark:bg-slate-800 border-t border-grey-200 dark:border-slate-700 py-12">
  <div class="container lg:max-w-3xl">
    <h3 class="font-medium text-2xl mb-2">Как понять, что ретрекер заработал?</h3>
    <p>Статус трекера «retracker.local» в вашем торрент-клиент на вкладке «Трекеры» (Trackers) должен измениться на «работает» (working) как на картинке ниже:</p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/100710/1_899GTp1JNl.png', 'w' => 594, 'h' => 25])
  </div>
</section>
@endsection
