@extends('retracker.base')

@section('content')
<section class="tw-pt-4 tw-pb-12">
  <div class="tw-container tw-max-w-3xl">
    <h3>При использовании трекеров rutracker.org, tapochek.net и tfile.ru</h3>
    <p>Эти трекеры автоматически добавляют ретрекер в каждый торрент-файл и вам нет необходимости проделывать эту операцию вручную.</p>

    <h3 class="tw-mt-12">При использовании других интернет-трекеров</h3>
    <p>Если вы решили скачать раздачу из интернета вместе с кем-либо и если ретрекера нет в списке трекеров скачанного торрент-файла, то вам необходимо выполнить следующие действия (на примере программы uTorrent 2.0.2):</p>
    <ul>
      <li>
        <p>выбрать в клиенте раздачу:</p>
        <p><img class="tw-max-w-full tw-h-auto" src="https://img.ivacuum.ru/g/100710/1_58sS4cweRE.png" width="438" height="70"></p>
      </li>
      <li>
        <p>открыть вкладку «<strong>Трекеры</strong>» (Trackers):</p>
        <p><img class="tw-max-w-full tw-h-auto" src="https://img.ivacuum.ru/g/100710/1_I1jXoj2RI3.png" width="619" height="116"></p>
      </li>
      <li>
        <p>нажать <img src="https://ivacuum.org/i/_/mouse_select_right.png" width="16" height="16"> в пространстве окошка со списком трекеров и выбрать «<strong>Добавить трекер</strong>»:</p>
        <p><img class="tw-max-w-full tw-h-auto" src="https://img.ivacuum.ru/g/100710/1_g5STffKBb4.png" width="236" height="146"></p>
      </li>
      <li>
        <p>добавить строку «<strong>http://retracker.local/announce</strong>», как показано на рисунке:</p>
        <p><img class="tw-max-w-full tw-h-auto" src="https://img.ivacuum.ru/g/100710/1_ZnPu3tIvZm.png" width="469" height="646"></p>
      </li>
      <li>нажать «OK».</li>
    </ul>
    <div>Ретрекер должны добавлять <span class="tw-font-bold">все</span> пользователи, которые собрались качать раздачу.</div>
  </div>
</section>
@endsection
