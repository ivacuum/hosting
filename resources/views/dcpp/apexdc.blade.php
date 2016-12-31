@extends('dcpp.software', [
  'meta_title' => trans('meta_title.dcpp.apexdc'),
  'software_title' => trans('dcpp.apexdc'),
  'software' => [
    ['version' => '1.4.3', 'id' => 141, 'size' => 12395187, 'dl_suffix' => ''],
    ['version' => '1.4.2', 'id' => 137, 'dl_suffix' => ''],
  ],
  'developer_site' => 'http://www.apexdc.net/',
])

@section('download_latest')
<p>
  <a class="btn btn-success" href="{{ action('Files@download', 141) }}">
    @svg (windows)
    {{ trans('dcpp.download') }}
    &middot;
    {{ ViewHelper::size(12395187) }}
  </a>
  @ru
    &nbsp;
    <a class="btn btn-primary" href="{{ action('Files@download', 22) }}">
      Файл русификации
      &middot;
      {{ ViewHelper::size(90145) }}
    </a>
    &nbsp;
    <a class="btn btn-default" href="{{ action('Dcpp@page', 'rus_setup') }}">Инструкция по русификации</a>
  @endlang
</p>
@endsection

@section('about_software')
@ru
  <p><strong>ApexDC++</strong> — это полностью бесплатный клиент для работы в P2P сетях. Он был разработан профессионалами и с учетом потребностей и пожеланий простых пользователей. Данный клиент был построен на базе <a class="link" href="{{ action('Dcpp@page', 'strongdc') }}">StrongDC++</a> с улучшениями и доработками. В составе ApexDC++ есть специальный плагин для блокировки определенных IP-адресов. Присутствует возможность максимальной настройки программы для удобства пользователя, поддерживается смена тем.</p>
  <p>Удобный интерфейс программы ApexDC++ позволит легко обмениваться файлами в пиринговых сетях.</p>
@en
  <p><strong>ApexDC++</strong> is a free DC++ client software. It is based on <a class="link" href="{{ action('Dcpp@page', 'strongdc') }}">StrongDC++</a> and including many its features. ApexDC++ contains plugin which may prevent connections from and to certain subnetworks.</p>
@endlang
@endsection
