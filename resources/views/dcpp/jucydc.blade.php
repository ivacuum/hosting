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
<h4>{{ trans('dcpp.for') }} @svg (windows) Windows</h4>
<a class="btn btn-success" href="{{ action('Files@download', 49) }}">
  @svg (windows)
  {{ trans('dcpp.download') }} 32bit
  &middot;
  {{ ViewHelper::size(36586416) }}
</a>
&nbsp;
<a class="btn btn-success" href="{{ action('Files@download', 50) }}">
  @svg (windows)
  {{ trans('dcpp.download') }} 64bit
  &middot;
  {{ ViewHelper::size(36562647) }}
</a>

<h4>{{ trans('dcpp.for') }} @svg (linux) Linux</h4>
<a class="btn btn-success" href="{{ action('Files@download', 74) }}">
  @svg (linux)
  {{ trans('dcpp.download') }} 32bit
  &middot;
  {{ ViewHelper::size(36756573) }}
</a>
&nbsp;
<a class="btn btn-success" href="{{ action('Files@download', 148) }}">
  @svg (linux)
  {{ trans('dcpp.download') }} 64bit
  &middot;
  {{ ViewHelper::size(36924947) }}
</a>

<h4>{{ trans('dcpp.for') }} @svg (apple) macOS</h4>
<a class="btn btn-success" href="{{ action('Files@download', 51) }}">
  @svg (apple)
  {{ trans('dcpp.download') }} 32bit
  &middot;
  {{ ViewHelper::size(36626671) }}
</a>
&nbsp;
<a class="btn btn-success" href="{{ action('Files@download', 147) }}">
  @svg (apple)
  {{ trans('dcpp.download') }} 64bit
  &middot;
  {{ ViewHelper::size(36508412) }}
</a>
@endsection

@section('about_software')
@ru
  <p><strong>Jucy DC++</strong> — это новый DC++ клиент, разработка которого ведется около года. Сам клиент очень удобен, поддерживает мультипотоковую скачку, обладает приятным интерфейсом. Основное отличие клиента от остальных — наличие версий для macOS и Linux.</p>
@en
  <p><strong>Jucy DC++</strong> is a multiplatform DC++ client software.</p>
@endlang
@endsection
