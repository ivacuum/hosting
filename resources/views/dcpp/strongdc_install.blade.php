@extends('dcpp.base', [
  'noLanguageSelector' => $locale === 'ru',
])

@section('content_header')
@parent
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@parent
@endsection

@section('content')
@ru
  <h1>Инструкция по установке и настройке StrongDC++</h1>
  <h2>Установка</h2>
  <ol>
    <li>
      <p>Скачайте программу-клиент <a class="link" href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'strongdc') }}">StrongDC++</a>.</p>
      <p>
        <a class="btn btn-success my-1 mr-2" href="{{ path([App\Http\Controllers\Files::class, 'download'], 132) }}">
          <span class="mr-1">
            @svg (windows)
          </span>
          {{ __('Скачать') }} 32-Bit &middot; {{ ViewHelper::size(8_046_097) }}
        </a>
        <a class="btn btn-success my-1" href="{{ path([App\Http\Controllers\Files::class, 'download'], 134) }}">
          <span class="mr-1">
            @svg (windows)
          </span>
          {{ __('Скачать') }} 64-Bit &middot; {{ ViewHelper::size(16_138_442) }}
        </a>
      </p>
    </li>
    <li>
      <p>Запустите установочный файл, чтобы начать установку. Перед вами появится «Окно установки программы»:</p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_lEWbwRVqo5.png" width="511" height="394" alt=""></p>
      <p>Следуйте указанием <b>Мастера установки</b>.</p>
      <p>После окончания инсталяции программы, перед вами откроется окно для автоматической русификации и настройки клиента.</p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_WK1WL88b3A.png" width="512" height="322" alt=""></p>
      <p>Введите в нём ваш Ник, IP, и путь для сохранения файлов, которые вы будете качать от пользователей в DC++.</p>
    </li>
  </ol>

  <h2 class="mt-12">Настройка</h2>
  <p><b>Примечание</b>: если появится окно «Оповещение системы безопасности Windows» – выберите «Разблокировать».</p>
  <p>При первом запуске программы вам понадобится провести следующие настройки:</p>
  <ol class="mb-4">
    <li>Настройки хаба:
      <ul>
        <li>Нажмите на кнопку <b>«Любимые Хабы»</b> на верхней панели.</li>
        <li>Нажмите на кнопку <b>«Новый»</b> или <b>«New»</b> в левом нижнем углу.</li>
        <li>
          <p>Заполните поля, выделенные на рисунке.</p>
          <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_Zs6WYrKY1d.png" width="301" height="285" alt=""></p>
        </li>
      </ul>
    </li>
    <li>
      <p>Ввод личной информации:</p>
      <p>Для ввода личной информации откройте <b>Настройки</b> программы (для этого в левом верхнем углу экрана нажмите на кнопку <b>Файл</b>, в открывшемся меню выберите пункт <b>Настройки…</b>.</p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_KxCdu1b2Y9.png" width="663" height="497" alt=""></p>
      <p>Заполните поля «<b>E-mail</b>» и «<b>Описание</b>» по своему усмотрению (необязательно).</p>
    </li>
    <li>
      <p>Выберите вкладку <b>Шара</b>.</p>
      <p>В окне <b>Расшаренные папки</b> поставьте галочки на тех папках, которые вы хотите сделать доступными для скачивания другим пользователям.</p>
      <p><b>Примечание:</b> суммарный объем расшаренной информации должен удовлетворять требованиям Хаба.</p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_cfeHm8UJec.png" width="663" height="497" alt=""></p>
      <p>Появится окно <b>Расшаривания информации:</b></p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_79DysYkU2m.png" width="651" height="209" alt=""></p>
      <p>Дождитесь завершения процесса расшаривания и нажмите кнопку <b>ОК</b>.</p>
    </li>
    <li>
      <p>Добро пожаловать на DC++ хаб.</p>
      <p>Справа вы можете увидеть список пользователей, слева — чат.</p>
      <p>Для получения списка файлов пользователя сделайте на нём двойной клик мышкой. Внизу появится зеленая полоска — индикатор загрузки файл-листа. Для скачивания файла, нажмите по нему двойным щелчком мыши.</p>
      <p>
        <a href="https://img.ivacuum.ru/g/091001/1_BJDziOKhf1.png">
          <img class="screenshot" src="https://img.ivacuum.ru/g/091001/s/1_BJDziOKhf1.png" width="360" height="301" alt="">
        </a>
      </p>
      <p><b>Примечание:</b> по умолчанию фалы скачиваются в папку <b>C:\Downloads\DC++</b>. Для изменения этой папки зайдите в <b>Файл — Настройки — Скачка</b></p>
      <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/091002/1_AOnVj3WH11.png" width="663" height="497" alt=""></p>
    </li>
  </ol>
  <p>
    <a class="link" href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'strongdc') }}">
      &larr;
      <span class="sm:hidden">Вернуться к StrongDC++</span>
      <span class="hidden sm:inline">Вернуться на страницу клиента StrongDC++</span>
    </a>
  </p>
@endru
@endsection
