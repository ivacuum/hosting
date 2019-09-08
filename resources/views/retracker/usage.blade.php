@extends('retracker.base')

@section('content')
<section class="pt-4 pb-12">
  <div class="container lg:max-w-3xl">
    <h3>При использовании трекеров rutracker.org, tapochek.net и tfile.ru</h3>
    <p>Эти трекеры автоматически добавляют ретрекер в каждый торрент-файл и вам нет необходимости проделывать эту операцию вручную.</p>

    <h3 class="mt-12">При использовании других интернет-трекеров</h3>
    <p>Если вы решили скачать раздачу из интернета вместе с кем-либо и если ретрекера нет в списке трекеров скачанного торрент-файла, то вам необходимо выполнить следующие действия (на примере программы uTorrent 2.0.2):</p>
    <p>
      <span class="inline-flex bg-gray-600 text-white px-2 font-medium rounded mr-1">1</span>
      Выбрать в клиенте раздачу:
    </p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/100710/1_58sS4cweRE.png', 'w' => 438, 'h' => 70])

    <p>
      <span class="inline-flex bg-gray-600 text-white px-2 font-medium rounded mr-1">2</span>
      Открыть вкладку «<span class="font-bold">Трекеры</span>» (Trackers):
    </p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/100710/1_I1jXoj2RI3.png', 'w' => 619, 'h' => 116])

    <p>
      <span class="inline-flex bg-gray-600 text-white px-2 font-medium rounded mr-1">3</span>
      Нажать <img class="inline w-4 h-4" src="https://ivacuum.org/i/_/mouse_select_right.png" alt=""> в пространстве окошка со списком трекеров и выбрать «<span class="font-bold">Добавить трекер</span>»:
    </p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/100710/1_g5STffKBb4.png', 'w' => 236, 'h' => 146])

    <p>
      <span class="inline-flex bg-gray-600 text-white px-2 font-medium rounded mr-1">4</span>
      Добавить строку «<span class="font-bold">http://retracker.local/announce</span>», как показано на рисунке:
    </p>
    <p><img class="max-w-full h-auto" src="https://img.ivacuum.ru/g/100710/1_ZnPu3tIvZm.png" alt="" width="469" height="646"></p>

    <p>
      <span class="inline-flex bg-gray-600 text-white px-2 font-medium rounded mr-1">5</span>
      Нажать «<span class="font-bold">OK</span>».
    </p>

    <div>Ретрекер должны добавлять <span class="font-bold">все</span> пользователи, которые собрались качать раздачу.</div>
  </div>
</section>
@endsection
