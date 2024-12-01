@extends('dcpp.base')

@section('content')
<div class="hanging-punctuation-first lg:text-lg grid md:grid-cols-4 gap-8">
  <div>
    <h1 class="font-medium text-4xl tracking-tight mb-2">@lang('О DC++')</h1>
    <div class="font-medium text-2xl text-grey-500 mb-2">@lang('Клиенты')</div>
    <div class="flex flex-col w-full">
      <a class="font-medium py-1" href="@lng/dc/airdc">@lang('dcpp.airdc')</a>
      <a class="font-medium py-1" href="@lng/dc/apexdc">@lang('dcpp.apexdc')</a>
      <a class="font-medium py-1" href="@lng/dc/dcpp">@lang('dcpp.dcpp')</a>
      <a class="font-medium py-1" href="@lng/dc/flylinkdc">@lang('dcpp.flylinkdc')</a>
      <a class="font-medium py-1" href="@lng/dc/greylinkdc">@lang('dcpp.greylinkdc')</a>
      <a class="font-medium py-1" href="@lng/dc/jucydc">@lang('dcpp.jucydc')</a>
      @ru
        <a class="font-medium py-1" href="@lng/dc/kalugadc">@lang('dcpp.kalugadc')</a>
      @endru
      <a class="font-medium py-1" href="@lng/dc/pelinkdc">@lang('dcpp.pelinkdc')</a>
      <a class="font-medium py-1" href="@lng/dc/shakespeer">@lang('dcpp.shakespeer')</a>
      <a class="font-medium py-1" href="@lng/dc/strongdc">@lang('dcpp.strongdc')</a>
    </div>
  </div>
  <div class="md:col-span-3">
    @ru
      <h2 class="font-medium text-3xl tracking-tight mb-2 md:mt-0">Что такое пиринговая сеть?</h2>
      <p><strong>Пиринговая сеть</strong> (Peer-to-peеr или P2P) — это обмен файлами между пользователями сети. Все пользователи подключаются к единому серверу, где происходит аккумуляция списков файлов у пользователей, потом эти файлы уже напрямую скачиваются между двумя пользователями сети.</p>
      <p>Говоря проще, вы сможете «увидеть» и скачать файлы, открытые для доступа другим абонентом сети, а также, открыв доступ к своим файлам, позволить скачать их у вас.</p>
    @en
      <h2 class="font-medium text-3xl tracking-tight mb-2 md:mt-0">What is P2P network?</h2>
      <p>A peer-to-peer network allows users to share files with other users. All users connect to a special computer called a hub that routes search requests/results and facilitates clients to connect to each other. All file transfers are being made directly between clients, not through the hub.</p>
    @endru

    @ru
      <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">Как это работает?</h2>
      <p>С помощью специальной программы-клиента (DC++), вы подключаетесь к серверу (хабу), находите нужный вам файл через поиск по всем компьютерам сети или при просмотре списка открытых для доступа файлов на компьютере одного из пользователей, и добавляете этот файл в очередь закачки.</p>
      <ul>
        <li>Программа-клиент сама скачает файл.</li>
        <li>Если файл большой, она скачает его по частям одновременно с нескольких компьютеров сети.</li>
        <li>При отключении хозяина файла или если его компьютер перегружен запросами, попытается найти файл на других компьютерах.</li>
        <li>При медленной скорости найдет источник, с которого скачивание выполняется быстрее.</li>
        <li>При подключении пользователей попытается найти нужный вам файл на их компьютерах.</li>
        <li>После закачки проверит целостность файла.</li>
        <li>В это время вы можете искать и качать другие файлы или общаться во встроенном чате с другими пользователями.</li>
      </ul>
    @en
      <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">How does it work?</h2>
      <p>First of all, you need a DC++ client software. Then, you can connect to the hub, search for the files you need and put them into a download queue. You may also view all the files a single user shared with everyone.</p>
      <ul>
        <li>The DC++ client software will download files.</li>
        <li>If the file is large, it will split it into pieces and download from multiple computers on the network.</li>
        <li>It will find a better user to download from if the speed is too low.</li>
        <li>It will perform a file integrity check while it is being downloaded.</li>
      </ul>
    @endru

    @ru
      <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">Пользоваться DC++</h2>
      <ul>
        <li><strong>Удобно</strong>: вам не нужно знать адреса компьютеров или сканировать сеть: клиент все сделает за вас.</li>
        <li><strong>Быстро</strong>: клиенты соединяются напрямую, за счет чего достигается скорость, большая, чем при работе через сетевое окружение или FTP.</li>
        <li><strong>Надежно</strong>: проверка контрольной суммы файла гарантирует, что файл не «побился» при скачивании.</li>
        <li><strong>Экономно</strong>: абсолютно бесплатный доступ к терабайтам разнообразнейших данных.</li>
        <li><strong>Универсально</strong>: клиенты на любой вкус с различными возможностями и под любую ОС: от <span class="whitespace-nowrap">@svg (windows) Windows</span> до <span class="whitespace-nowrap">@svg (apple) macOS</span>.</li>
      </ul>
    @en
      <h2 class="font-medium text-3xl tracking-tight mb-2 mt-12">Using DC++ is</h2>
      <ul>
        <li><strong>Easy</strong>: you don't even need to remember computer IPs or scan the network for the files. The client software will do it for you.</li>
        <li><strong>Fast</strong>: files are being split into pieces and downloaded from multiple computers.</li>
        <li><strong>Reliably</strong>: pieces are checked when downloaded.</li>
        <li><strong>Free</strong>: access to terabytes of data.</li>
        <li><strong>Universally</strong>: it is available for Windows, Linux, and macOS.</li>
      </ul>
    @endru
  </div>
</div>
@endsection
