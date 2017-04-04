@extends('dcpp.base')

@section('content')
<h1 class="mt-0">{{ trans('dcpp.index') }}</h1>

<p>
  <a class="link" href="{{ path('Dcpp@page', 'airdc') }}">{{ trans('dcpp.airdc') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'apexdc') }}">{{ trans('dcpp.apexdc') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'dcpp') }}">{{ trans('dcpp.dcpp') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'flylinkdc') }}">{{ trans('dcpp.flylinkdc') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'greylinkdc') }}">{{ trans('dcpp.greylinkdc') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'jucydc') }}">{{ trans('dcpp.jucydc') }}</a>
  @ru
    <span class="text-muted">&nbsp;&middot;&nbsp;</span>
    <a class="link" href="{{ path('Dcpp@page', 'kalugadc') }}">{{ trans('dcpp.kalugadc') }}</a>
  @endlang
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'pelinkdc') }}">{{ trans('dcpp.pelinkdc') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'shakespeer') }}">{{ trans('dcpp.shakespeer') }}</a>
  <span class="text-muted">&nbsp;&middot;&nbsp;</span>
  <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">{{ trans('dcpp.strongdc') }}</a>
</p>

<div class="row">
  <div class="col-md-4">
    @ru
      <h2>Что такое пиринговая сеть?</h2>
      <p><strong>Пиринговая сеть</strong> (Peer-to-peеr) — это обмен файлами между пользователями сети. Все пользователи подключаются к единому серверу, где происходит аккумуляция списков файлов у пользователей, потом эти файлы уже скачиваются между двумя пользователями.</p>
      <p>Говоря проще – вы сможете «увидеть» и скачать файлы, открытые для доступа другим абонентом сети, а также, открыв доступ к своим файлам, позволить скачать их у вас.</p>
    @en
      <h2>What is P2P network?</h2>
      <p>Peer-to-peer network allows users to share files with other users. All users connect to the special computer called hub that routes search requests/results and facilitates clients to connect to each other. All file transfers are being made directly between clients, not through the hub.</p>
    @endlang
  </div>
  <div class="col-md-4">
    @ru
      <h2>Как это работает?</h2>
      <p>С помощью специальной программы-клиента (DC++), Вы подключаетесь к нашему серверу (хабу), находите нужный вам файл через поиск по всем компьютерам нашей сети или при просмотре списка открытых для доступа файлов на компьютере одного из пользователей, и добавляете этот файл в очередь закачки.</p>
      <ul>
        <li>программа-клиент сама скачает файл</li>
        <li>если файл большой - она скачает его по частям одновременно с нескольких компьютеров сети</li>
        <li>при отключении хозяина файла, или если его компьютер перегружен запросами, попытается найти файл на других компьютерах</li>
        <li>при слишком медленной скорости найдет источник, скачка с которого быстрее</li>
        <li>при подключении каждого пользователя попытается найти нужный вам файл на его компьютере</li>
        <li>после закачки проверит целостность файла</li>
        <li>в это время вы можете искать и качать другие файлы или общаться во встроенном чате с другими пользователями</li>
      </ul>
    @en
      <h2>How does it work?</h2>
      <p>First of all you need DC++ client software. Then you can connect to the hub, search for the files you need and put them into download queue. You may also view all the files single user shared with everyone.</p>
      <ul>
        <li>DC++ client software will download files</li>
        <li>if the file is large, it will split it into pieces and download multiple computers on the network</li>
        <li>it will find better user to download from if the speed is too low</li>
        <li>it will perform file integrity check while it is being downloaded</li>
      </ul>
    @endlang
  </div>
  <div class="col-md-4">
    @ru
      <h2>Работать с DC++:</h2>
      <ul>
        <li><strong>Удобно</strong>: вам не нужно знать адреса компьютеров или сканировать сеть: клиент все сделает за вас.</li>
        <li><strong>Быстро</strong>: клиенты соединяются напрямую, за счет чего достигается скорость, большая, чем при работе через сетевое окружение или ftp.</li>
        <li><strong>Надежно</strong>: проверка контрольной суммы файла гарантирует, что файл не «побился» при скачке.</li>
        <li><strong>Экономно</strong>: абсолютно бесплатный доступ к терабайтам разнообразнейших данных.</li>
        <li><strong>Универсально</strong>: клиенты на любой вкус с различными возможностями и под любую ОС — от Windows до Mac OS.</li>
      </ul>
    @en
      <h2>Using DC++ is</h2>
      <ul>
        <li>Easy: you don't even need to remember computers ip's or scan network for the files. Client software will do it for you.</li>
        <li>Fast: files are being splitted into pieces and downloaded from multiple computers.</li>
        <li>Reliably: pieces are checked when downloaded.</li>
        <li>Free access to terabytes of data.</li>
        <li>Universally: it is available on Windows, Linux and Mac OS.</li>
      </ul>
    @endlang
  </div>
</div>
@endsection
