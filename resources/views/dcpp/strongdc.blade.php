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
<a class="btn btn-success btn-lg my-1 mr-2" href="{{ path('Files@download', 132) }}">
  <span class="mr-1">
    @svg (windows)
  </span>
  {{ trans('dcpp.download') }} 32-Bit &middot; {{ ViewHelper::size(8046097) }}
</a>
<a class="btn btn-success btn-lg my-1 mr-2" href="{{ path('Files@download', 134) }}">
  <span class="mr-1">
    @svg (windows)
  </span>
  {{ trans('dcpp.download') }} 64-Bit &middot; {{ ViewHelper::size(16138442) }}
</a>
@endsection

@section('about_software')
@ru
  <p><strong>StrongDC++</strong> — это мощный клиент, позволяющий работать в P2P сети и обмениваться любыми файлами и приложениями. При помощи StrongDC++ вы сможете качать файлы от пользователей, находящихся в каком-то одном регионе или городе, фильмы, которые были выпущены только в какой-то одной стране. Или загрузить только файлы маленького размера, которые вы вряд ли сможете найти обычной поисковой машиной.</p>
  <div class="tw-mt-6">
    <a class="btn btn-default" href="{{ path('Dcpp@page', 'strongdc_install') }}">Инструкция по установке</a>
  </div>
@en
  <p><strong>StrongDC++</strong> is a powerful client for sharing files in Direct Connect network by using NMDC and ADC protocols. It is a modification of an <a class="link" href="{{ path('Dcpp@page', 'dcpp') }}">original DC++ client</a> and it brings many new features. Sadly, last release was a while ago, but it's still a very good client to share some files. Right after installation you would need to type your name and select folders to share and you are good to go.</p>
@endru
@endsection

@section('software_features')
<section class="my-0 py-5">
  <div class="container">
    <h3 class="tw-mb-6">
      @ru
        Основные преимущества StrongDC++
      @en
        Main features of StrongDC++
      @endru
    </h3>
    <div class="row">
      <div class="col-md-6 col-lg-4">
        <h5>
          @ru
            Сегментационная закачка файла
          @en
            Segmented downloading
          @endru
        </h5>
        @ru
          <p>Загружаемый вами файл автоматически разделяется на много маленьких сегментов и качается одновременно сразу с нескольких пользователей. Благодаря этому скорость закачки файла получается выше, а автоматическая проверка файла после закачки гарантирует то, что файл не будет поврежден.</p>
        @en
          <p>Files are divided to many parts and they are downloaded from many users in parallel. Checksum guarantees combined parts are identical to an original file.</p>
        @endru
      </div>
      <div class="col-md-6 col-lg-4">
        <h5>
          @ru
            Частичное расшаривание файла
          @en
            Partial files sharing
          @endru
        </h5>
        @ru
          <p>Если закачиваемый вами файл качают другие пользователи, то они будут выступать для вас источником недостающих данных, как и вы для них. То есть закачанные сегменты файлов будут расшариваться автоматически для улучшения обмена во всей сети DC++.</p>
        @en
          <p>You start sharing segments you've downloaded right away. So as other users. Better speed for everyone.</p>
        @endru
      </div>
      <div class="col-md-6 col-lg-4">
        <h5>
          @ru
            Персональная настройка
          @en
            Customization
          @endru
        </h5>
        @ru
          <p>Вы можете настроить звуковые оповещения, всплывающие окна, смайлики в чатах и многое другое на свое усмотрение. Это позволяет сделать работу со StrongDC++ максимально удобной.</p>
        @en
          <p>You have lots of options to fine-tune: sound notifications, popup windows, smilies, etc.</p>
        @endru
      </div>
      <div class="col-md-6 col-lg-4">
        <h5>
          @ru
            Отключение медленных соединений
          @en
            Disconnect slow users
          @endru
        </h5>
        @ru
          <p>StrongDC++ автоматически отключает те соединения, где скорость обмена наименьшая, чтобы освободить слоты для других пользователей.</p>
        @en
          <p>It frees slots for high-speed exchange.</p>
        @endru
      </div>
      <div class="col-md-6 col-lg-4">
        <h5>
          @ru
            Ограничение на загрузку и отдачу
          @en
            Bandwidth throttling
          @endru
        </h5>
        @ru
          <p>Вы можете установить с какой скоростью будет производиться загрузка и отдача файлов с вашего компьютера. Это позволяет снизить нагрузку на жесткий диск и сеть.</p>
        @en
          <p>Control your network and hard drive utilization.</p>
        @endru
      </div>
    </div>
  </div>
</section>
@endsection
