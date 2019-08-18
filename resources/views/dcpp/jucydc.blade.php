@extends('dcpp.software', [
  'software_title' => trans('dcpp.jucydc'),
  'software' => [
    ['version' => '0.85', 'id' => 49, 'dl_suffix' => ''],
  ],
  'software_screenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/091002/1_ZaESRgyfi0.jpg',
      'thumb' => 'https://img.ivacuum.ru/g/091002/s/1_ZaESRgyfi0.jpg',
    ],
  ],
  'developer_site' => 'http://www.jucy.eu/',
])

@section('download_latest')
<div {{ Illuminate\Support\Str::contains($css_classes, ['linux', 'macos']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4>{{ trans('dcpp.for') }} @svg (windows) Windows</h4>
  <a class="btn btn-success btn-lg my-1 mr-2" href="{{ path('Files@download', 49) }}">
    {{ trans('dcpp.download') }} 32bit
    &middot;
    {{ ViewHelper::size(36586416) }}
  </a>
  <a class="btn btn-success btn-lg my-1" href="{{ path('Files@download', 50) }}">
    {{ trans('dcpp.download') }} 64bit
    &middot;
    {{ ViewHelper::size(36562647) }}
  </a>
</div>

<div {{ !Illuminate\Support\Str::contains($css_classes, ['linux']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4 class="mt-3">{{ trans('dcpp.for') }} @svg (linux) Linux</h4>
  <a class="btn btn-success btn-lg my-1 mr-2" href="{{ path('Files@download', 74) }}">
    {{ trans('dcpp.download') }} 32bit
    &middot;
    {{ ViewHelper::size(36756573) }}
  </a>
  <a class="btn btn-success btn-lg my-1" href="{{ path('Files@download', 148) }}">
    {{ trans('dcpp.download') }} 64bit
    &middot;
    {{ ViewHelper::size(36924947) }}
  </a>
</div>

<div {{ !Illuminate\Support\Str::contains($css_classes, ['macos']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4 class="mt-3">{{ trans('dcpp.for') }} @svg (apple) macOS</h4>
  <a class="btn btn-success btn-lg my-1 mr-2" href="{{ path('Files@download', 51) }}">
    {{ trans('dcpp.download') }} 32bit
    &middot;
    {{ ViewHelper::size(36626671) }}
  </a>
  <a class="btn btn-success btn-lg my-1" href="{{ path('Files@download', 147) }}">
    {{ trans('dcpp.download') }} 64bit
    &middot;
    {{ ViewHelper::size(36508412) }}
  </a>
</div>

<div>
  <button class="btn btn-default mt-4 js-dcpp-clients-show" data-target=".js-dcpp-client">
    @ru
      Показать клиенты для всех ОС
    @en
      Show clients for other OSes
    @endru
  </button>
</div>
@endsection

@section('about_software')
@ru
  <p><strong>Jucy DC++</strong> — это клиент для файлообменной сети DC++. Он очень удобен, поддерживает мультипотоковую скачку, обладает приятным интерфейсом. Основное отличие клиента от остальных — наличие версий для macOS и Linux. Если выбор Linux или macOS вас ранее ограничивал в возможностях обмена файлами, то эти времена прошли.</p>
  <p>В базовой поставке нет русского языка. Если для вас это критичный фактор, то обратите внимание на другие клиенты на нашем сайте, например, на <a class="link" href="{{ path('Dcpp@page', 'flylinkdc') }}">FlyLinkDC++</a>.</p>
@en
  <p><strong>Jucy DC++</strong> is a peer-to-peer client software. It's main feature is that it supports many OSes: Windows, Linux, macOS. So now you are finally able to share files while using Linux or macOS.</p>
@endru
@endsection

@section('software_features')
<section class="my-0 py-5">
  <div class="container">
    @ru
    <h3>Основные преимущества Jucy DC++</h3>
    <ul>
      <li>Поддержка множества операционных систем.</li>
      <li>Автоматическое обновление клиента.</li>
      <li>Поддержка плагинов: флаги стран, смайлики и т.п.</li>
      <li>Возможность установки лимитов скорости</li>
      <li>Сегментная закачка — загрузка файлов по частям со многих пользователей для ускорения процесса обмена</li>
      <li>Полнотекстовый поиск по документам</li>
    </ul>
    @en
    <h3>Main features of Jucy DC++</h3>
    <ul>
      <li>Support many operating systems</li>
      <li>Automatic update of the client.</li>
      <li>Plugin support: country flags, smilies, etc.</li>
      <li>Bandwidth throttling</li>
      <li>Segmented downloading</li>
      <li>Full text indexing for document search</li>
    </ul>
    @endru
  </div>
</section>
@endsection
