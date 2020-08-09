@extends('dcpp.software', [
  'softwareTitle' => __('dcpp.strongdc'),
  'software' => [
    ['version' => '2.42', 'id' => 132, 'dl_suffix' => ''],
    ['version' => '2.41', 'id' => 98, 'dl_suffix' => ' 32bit'],
    ['version' => '2.41', 'id' => 100, 'dl_suffix' => ' 64bit'],
  ],
  'softwareScreenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/091001/1_BJDziOKhf1.png',
      'thumb' => 'https://img.ivacuum.ru/g/091001/s/1_BJDziOKhf1.png',
    ],
  ],
  'developerSite' => 'http://strongdc.sourceforge.net/?lang=eng',
])

@section('download_latest')
<a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="@lng/files/132/dl">
  <span class="mr-1">
    @svg (windows)
  </span>
  @lang('Скачать') 32-Bit &middot; {{ ViewHelper::size(8_046_097) }}
</a>
<a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="@lng/files/134/dl">
  <span class="mr-1">
    @svg (windows)
  </span>
  @lang('Скачать') 64-Bit &middot; {{ ViewHelper::size(16_138_442) }}
</a>
@endsection

@section('about_software')
@ru
  <p><strong>StrongDC++</strong> — это мощный клиент, позволяющий работать в P2P сети и обмениваться любыми файлами и приложениями. При помощи StrongDC++ вы сможете качать файлы от пользователей, находящихся в каком-то одном регионе или городе, фильмы, которые были выпущены только в какой-то одной стране. Или загрузить только файлы маленького размера, которые вы вряд ли сможете найти обычной поисковой машиной.</p>
  <div class="mt-6">
    <a class="btn btn-default" href="@lng/dc/strongdc_install">Инструкция по установке</a>
  </div>
@en
  <p><strong>StrongDC++</strong> is a powerful client for sharing files in Direct Connect network by using NMDC and ADC protocols. It is a modification of an <a class="link" href="@lng/dc/dcpp">original DC++ client</a> and it brings many new features. Sadly, last release was a while ago, but it's still a very good client to share some files. Right after installation you would need to type your name and select folders to share and you are good to go.</p>
@endru
@endsection

@section('software_features')
<section class="my-0 py-12">
  <div class="container">
    <h3 class="mb-6">
      @ru
        Основные преимущества StrongDC++
      @en
        Main features of StrongDC++
      @endru
    </h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div>
        <h5>
          @ru
            Сегментационная закачка файла
          @en
            Segmented downloading
          @endru
        </h5>
        @ru
          <div>Загружаемый вами файл автоматически разделяется на много маленьких сегментов и качается одновременно сразу с нескольких пользователей. Благодаря этому скорость закачки файла получается выше, а автоматическая проверка файла после закачки гарантирует то, что файл не будет поврежден.</div>
        @en
          <div>Files are divided to many parts and they are downloaded from many users in parallel. Checksum guarantees combined parts are identical to an original file.</div>
        @endru
      </div>
      <div>
        <h5>
          @ru
            Частичное расшаривание файла
          @en
            Partial files sharing
          @endru
        </h5>
        @ru
          <div>Если закачиваемый вами файл качают другие пользователи, то они будут выступать для вас источником недостающих данных, как и вы для них. То есть закачанные сегменты файлов будут расшариваться автоматически для улучшения обмена во всей сети DC++.</div>
        @en
          <div>You start sharing segments you've downloaded right away. So as other users. Better speed for everyone.</div>
        @endru
      </div>
      <div>
        <h5>
          @ru
            Персональная настройка
          @en
            Customization
          @endru
        </h5>
        @ru
          <div>Вы можете настроить звуковые оповещения, всплывающие окна, смайлики в чатах и многое другое на свое усмотрение. Это позволяет сделать работу со StrongDC++ максимально удобной.</div>
        @en
          <div>You have lots of options to fine-tune: sound notifications, popup windows, smilies, etc.</div>
        @endru
      </div>
      <div>
        <h5>
          @ru
            Отключение медленных соединений
          @en
            Disconnect slow users
          @endru
        </h5>
        @ru
          <div>StrongDC++ автоматически отключает те соединения, где скорость обмена наименьшая, чтобы освободить слоты для других пользователей.</div>
        @en
          <div>It frees slots for high-speed exchange.</div>
        @endru
      </div>
      <div>
        <h5>
          @ru
            Ограничение на загрузку и отдачу
          @en
            Bandwidth throttling
          @endru
        </h5>
        @ru
          <div>Вы можете установить с какой скоростью будет производиться загрузка и отдача файлов с вашего компьютера. Это позволяет снизить нагрузку на жесткий диск и сеть.</div>
        @en
          <div>Control your network and hard drive utilization.</div>
        @endru
      </div>
    </div>
  </div>
</section>
@endsection
