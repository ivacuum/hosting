@extends('dcpp.software', [
  'softwareTitle' => trans('dcpp.greylinkdc'),
  'software' => [
    ['version' => '0.49', 'id' => 145, 'dl_suffix' => ''],
  ],
])

@section('download_latest')
<a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="{{ path([App\Http\Controllers\Files::class, 'download'], 145) }}">
  <span class="mr-1">
    @svg (windows)
  </span>
  {{ trans('dcpp.download') }} 32-Bit &middot; {{ ViewHelper::size(3_006_464) }}
</a>
<a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="{{ path([App\Http\Controllers\Files::class, 'download'], 146) }}">
  <span class="mr-1">
    @svg (windows)
  </span>
  {{ trans('dcpp.download') }} 64-Bit &middot; {{ ViewHelper::size(4_219_940) }}
</a>
@endsection

@section('about_software')
@ru
  <p><strong>GreyLinkDC++</strong> — очень удобная в использовании программа для файлообменных сетей DC++. В программу уже внесен список хабов с множеством высокоскоростных пользователей и выполнена настройка приоритетов, поэтому пользоваться можно сразу после установки. Вам остается лишь указать логин и папки для скачивания и раздачи. Если английский язык не ваш конек, то мы приготовили для вас русификатор и инструкцию по переключению языка.</p>
  <div class="mt-6">
    <a class="btn btn-primary my-1 mr-2" href="{{ path([App\Http\Controllers\Files::class, 'download'], 28) }}">
      Скачать русификатор &middot; {{ ViewHelper::size(108876) }}
    </a>
    <a class="btn btn-default my-1" href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'rus_setup') }}">Инструкция по русификации</a>
  </div>
@en
  <p><strong>GreyLinkDC++</strong> is a stable and optimized DC++ client software. It is provided with a list of hubs with lots of high-speed users, so you can use it pretty much right away. The only thing you are left to do is to type your name and select folders to share.</p>
@endru
@endsection

@section('software_features')
<section class="my-0 py-12">
  <div class="container">
    @ru
      <h3>Основные преимущества GreyLinkDC++</h3>
      <ul>
        <li>Улучшенная стабильность, низкое потребление ресурсов.</li>
        <li>Использование процессорного времени при нахождении на хабах с большим числом пользователей значительно ниже по сравнению с другими клиентами. Потребление памяти также немного ниже.</li>
        <li>Восстановление недокачанных и поврежденных файлов. Из меню «Файл» выбирается «Восстановление файла», указывается правильный магнет-линк и расположение поврежденного файла.</li>
      </ul>
    @en
      <h3>Main features of GreyLinkDC++</h3>
      <ul>
        <li>Improved stability and low resource usage.</li>
        <li>Low cpu usage on hubs with high amount of users in comparison with other DC++ clients. Memory footprint is also lower.</li>
        <li>Ability to restore incomplete and corrupted files.</li>
      </ul>
    @endru
  </div>
</section>
@endsection
