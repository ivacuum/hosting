@extends('dcpp.software', [
  'software_title' => trans('dcpp.strongdc'),
  'software' => [
    ['version' => '2.42', 'id' => 132, 'dl_suffix' => ''],
    ['version' => '2.41', 'id' => 98, 'dl_suffix' => ' 32bit'],
    ['version' => '2.41', 'id' => 100, 'dl_suffix' => ' 64bit'],
  ],
  'software_screenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/091001/1_BJDziOKhf1.png',
      'thumb' => 'https://img.ivacuum.ru/g/091001/s/1_BJDziOKhf1.png',
    ],
  ],
  'developer_site' => 'http://strongdc.sourceforge.net/?lang=eng',
])

@section('download_latest')
<a class="btn btn-success" href="{{ action('Files@download', 132) }}">
  @svg (windows)
  {{ trans('dcpp.download') }} 32bit
  &middot;
  {{ ViewHelper::size(8046097) }}
</a>
&nbsp;
<a class="btn btn-success" href="{{ action('Files@download', 134) }}">
  @svg (windows)
  {{ trans('dcpp.download') }} 64bit
  &middot;
  {{ ViewHelper::size(16138442) }}
</a>
@ru
  &nbsp;
  <a class="btn btn-default" href="{{ action('Dcpp@page', 'strongdc_install') }}">Инструкция по установке</a>
@endlang
@endsection

@section('about_software')
@ru
  <p><strong>StrongDC++</strong> — это мощный клиент, позволяющий работать в p2p сети и обмениваться любыми файлами и приложениями. При помощи StrongDC++ вы сможете качать файлы от пользователей, находящихся в каком-то одном регионе или городе, фильмы, которые были выпущены только в какой-то одной стране. Или загрузить только файлы маленького размера, которые Вы врятли сможете найти обычной поисковой машиной.</p>

  <div class="h3">Основные преимущества</div>
  <div class="row">
    <div class="col-md-4">
      <h5>Сегментационная закачка файла</h5>
      <p>Загружаемый вами файл автоматически разделяется на много маленьких сегментов и качается одновременно сразу от нескольких пользователей. Благодаря этому скорость закачки файла получается выше, а автоматическая проверка файла после закачки гарантирует то, что файл не будет поврежден.</p>
    </div>
    <div class="col-md-4">
      <h5>Частичное расшаривание файла</h5>
      <p>Если, закачиваемый вами файл, качают другие пользователи, то они будут выступать для вас тоже источником для скачки, а вы для них. То происходит автоматическое расшаривание закаченных сегментов файла.</p>
    </div>
    <div class="col-md-4">
      <h5>Персональная настройка</h5>
      <p>Вы можете настроить звуковые оповещения, всплывающие окна, смайлики в чатах по своему усмотрению. Это делает очень просто, и благодаря этому вы можете сделать работу со StrongDC++ максимально удобной.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h5>Отключение медленных соединений</h5>
      <p>StrongDC++ автоматически отключает те соединения, где скорость скачки\отдачи наименьшая, чтобы освободить слоты для других пользователей.</p>
    </div>
    <div class="col-md-4">
      <h5>Ограничение на загрузку и отдачу</h5>
      <p>Вы можете установить с какой скоростью будет производиться загрузка и отдача файлов с вашего компьютера.</p>
    </div>
  </div>
@en
  <p><strong>StrongDC++</strong> is a client for sharing files in Direct Connect network by using NMDC and ADC protocols. It is modification of program <a class="link" href="{{ action('Dcpp@page', 'dcpp') }}">DC++</a> and it brings many news and features from other modification.</p>
@endlang
@endsection
