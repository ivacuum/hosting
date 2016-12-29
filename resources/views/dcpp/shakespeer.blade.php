@extends('dcpp.software', [
  'software_title' => trans('dcpp.shakespeer'),
  'software' => [
    ['version' => '0.9.2', 'id' => 33, 'size' => 3159067, 'icon' => 'apple', 'dl_suffix' => ''],
  ],
])

@section('about_software')
@ru
  <p><strong>ShakesPeer</strong> — это клиент для работы в Peer2Peer сети в операционной системе macOS.</p>

  <h3>Примечание</h3>
  <p>Если после установки клиента у вас не будут отображатся русские шрифты, вам необходимо будет поменять кодировку для данного хаба в настройках, как показано на изображении ниже.</p>
  <p><img src="http://img.ivacuum.ru/g/091002/1_Km1HDRuJH0.png" width="760" height="432"></p>
@en
  <p><strong>ShakesPeer</strong> is a popular macOS DC++ client software.</p>
@endlang
@endsection
