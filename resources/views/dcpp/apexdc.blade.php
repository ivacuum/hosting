@extends('dcpp.software', [
  'softwareTitle' => __('dcpp.apexdc'),
  'software' => [
    ['version' => '1.6.4', 'id' => 154, 'size' => 23_018_257, 'dl_suffix' => ''],
    ['version' => '1.4.3', 'id' => 141, 'size' => 12_395_187, 'dl_suffix' => ''],
    ['version' => '1.4.2', 'id' => 137, 'dl_suffix' => ''],
  ],
  'developerSite' => 'https://www.apexdc.net/',
])

@section('download_latest')
<div>
  <a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="@lng/files/154/dl">
    <span class="mr-1">
      @svg (windows)
    </span>
    @lang('Скачать') 32-Bit &middot; {{ ViewHelper::size(23_018_257) }}
  </a>
  <a class="btn btn-success my-1 mr-2 text-lg px-4 py-2" href="@lng/files/155/dl">
    <span class="mr-1">
      @svg (windows)
    </span>
    @lang('Скачать') 64-Bit &middot; {{ ViewHelper::size(24_717_370) }}
  </a>
</div>
@endsection

@section('about_software')
@ru
  <p><strong>ApexDC++</strong> — это полностью бесплатный клиент для работы в P2P сетях. Он был разработан профессионалами и с учетом потребностей и пожеланий простых пользователей. Данный клиент был построен на базе <a class="link" href="@lng/dc/strongdc">StrongDC++</a> с улучшениями и доработками. В составе ApexDC++ есть специальный плагин для блокировки определенных IP-адресов. Присутствует возможность максимальной настройки программы для удобства пользователя, поддерживается смена тем.</p>
  <p>Удобный интерфейс программы ApexDC++ позволит легко обмениваться файлами в пиринговых сетях.</p>
  <div class="mt-6">
    <a class="btn btn-primary my-1 mr-2" href="@lng/files/157/dl">
      Скачать русификатор &middot; {{ ViewHelper::size(21464) }}
    </a>
    <a class="btn btn-default my-1" href="@lng/dc/rus_setup">Инструкция по русификации</a>
  </div>
@en
  <p><strong>ApexDC++</strong> is a free DC++ client software. It is based on <a class="link" href="@lng/dc/strongdc">StrongDC++</a> and including many its features. ApexDC++ contains plugin which may prevent connections from and to certain subnetworks.</p>
@endru
@endsection
