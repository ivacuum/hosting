@extends('dcpp.software', [
  'softwareTitle' => trans('dcpp.jucydc'),
  'software' => [
    ['version' => '0.85', 'id' => 49, 'dl_suffix' => ''],
  ],
  'softwareScreenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/091002/1_ZaESRgyfi0.jpg',
      'thumb' => 'https://img.ivacuum.ru/g/091002/s/1_ZaESRgyfi0.jpg',
    ],
  ],
  'developerSite' => 'http://www.jucy.eu/',
])

@section('download_latest')
<div {{ Str::contains($cssClasses, ['linux', 'macos']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4>{{ trans('dcpp.for') }} @svg (windows) Windows</h4>
  <a
    class="btn btn-success my-1 mr-2 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 49) }}"
  >
    @lang('Скачать') 32bit
    &middot;
    {{ ViewHelper::size(36_586_416) }}
  </a>
  <a
    class="btn btn-success my-1 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 50) }}"
  >
    @lang('Скачать') 64bit
    &middot;
    {{ ViewHelper::size(36_562_647) }}
  </a>
</div>

<div {{ !Str::contains($cssClasses, ['linux']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4 class="mt-4">{{ trans('dcpp.for') }} @svg (linux) Linux</h4>
  <a
    class="btn btn-success my-1 mr-2 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 74) }}"
  >
    @lang('Скачать') 32bit
    &middot;
    {{ ViewHelper::size(36_756_573) }}
  </a>
  <a
    class="btn btn-success my-1 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 148) }}"
  >
    @lang('Скачать') 64bit
    &middot;
    {{ ViewHelper::size(36_924_947) }}
  </a>
</div>

<div {{ !Str::contains($cssClasses, ['macos']) ? 'hidden' : '' }} class="js-dcpp-client">
  <h4 class="mt-4">{{ trans('dcpp.for') }} @svg (apple) macOS</h4>
  <a
    class="btn btn-success my-1 mr-2 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 51) }}"
  >
    @lang('Скачать') 32bit
    &middot;
    {{ ViewHelper::size(36_626_671) }}
  </a>
  <a
    class="btn btn-success my-1 text-lg px-4 py-2"
    href="{{ path([App\Http\Controllers\Files::class, 'download'], 147) }}"
  >
    @lang('Скачать') 64bit
    &middot;
    {{ ViewHelper::size(36_508_412) }}
  </a>
</div>

<div>
  <button class="btn btn-default mt-6 js-dcpp-clients-show" data-target=".js-dcpp-client">
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
  <p>В базовой поставке нет русского языка. Если для вас это критичный фактор, то обратите внимание на другие клиенты на нашем сайте, например, на <a class="link" href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'flylinkdc') }}">FlyLinkDC++</a>.</p>
@en
  <p><strong>Jucy DC++</strong> is a peer-to-peer client software. It's main feature is that it supports many OSes: Windows, Linux, macOS. So now you are finally able to share files while using Linux or macOS.</p>
@endru
@endsection

@section('software_features')
<section class="my-0 py-12">
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
