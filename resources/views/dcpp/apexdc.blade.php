@extends('dcpp.software', [
  'software_title' => trans('dcpp.apexdc'),
  'software' => [
    ['version' => '1.6.4', 'id' => 154, 'size' => 23018257, 'dl_suffix' => ''],
    ['version' => '1.4.3', 'id' => 141, 'size' => 12395187, 'dl_suffix' => ''],
    ['version' => '1.4.2', 'id' => 137, 'dl_suffix' => ''],
  ],
  'developer_site' => 'http://www.apexdc.net/',
])

@section('download_latest')
<p>
  <a class="btn btn-success mr-2" href="{{ path('Files@download', 154) }}">
    @svg (windows)
    {{ trans('dcpp.download') }} 32-Bit &middot; {{ ViewHelper::size(23018257) }}
  </a>
  <a class="btn btn-success mr-2" href="{{ path('Files@download', 155) }}">
    @svg (windows)
    {{ trans('dcpp.download') }} 64-Bit &middot; {{ ViewHelper::size(24717370) }}
  </a>
  @ru
    <a class="btn btn-primary mr-2" href="{{ path('Files@download', 157) }}">
      Файл русификации &middot; {{ ViewHelper::size(21464) }}
    </a>
    <a class="btn btn-default" href="{{ path('Dcpp@page', 'rus_setup') }}">Инструкция по русификации</a>
  @endru
</p>
@endsection

@section('about_software')
@ru
  <p><strong>ApexDC++</strong> — это полностью бесплатный клиент для работы в P2P сетях. Он был разработан профессионалами и с учетом потребностей и пожеланий простых пользователей. Данный клиент был построен на базе <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a> с улучшениями и доработками. В составе ApexDC++ есть специальный плагин для блокировки определенных IP-адресов. Присутствует возможность максимальной настройки программы для удобства пользователя, поддерживается смена тем.</p>
  <p>Удобный интерфейс программы ApexDC++ позволит легко обмениваться файлами в пиринговых сетях.</p>
@en
  <p><strong>ApexDC++</strong> is a free DC++ client software. It is based on <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a> and including many its features. ApexDC++ contains plugin which may prevent connections from and to certain subnetworks.</p>
@endru
@endsection
