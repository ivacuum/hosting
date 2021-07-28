@extends('dcpp.software', [
  'softwareTitle' => __('dcpp.dcpp'),
  'software' => [
    ['version' => '0.782', 'id' => 143, 'size' => 22_703_161, 'dl_suffix' => ''],
    ['version' => '0.770', 'id' => 110, 'dl_suffix' => ''],
  ],
  'softwareScreenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/091002/1_9Xb39T30l4.gif',
      'thumb' => 'https://img.ivacuum.ru/g/091002/s/1_9Xb39T30l4.gif',
    ],
  ],
  'developerSite' => 'https://dcplusplus.sourceforge.io/',
])

@section('about_software')
@ru
  <p><strong>DC++</strong> — популярный Peer 2 Peer клиент для сетей типа Direct Connect.</p>
  <p>Данная Peer 2 Peer система снискала огромную популярность в локальных сетях, практически заменив собою FTP-серверы. За последние 2-3 года я не встречал локальной сети, в которой не было бы развитого DC-сообщества. Можно сказать, что для обмена файлами в локалке — лучший, и, наверное, единственный реально используемый выбор. DC++ не обделен популярностью и в глобальной сети. Тысячи и тысячи пользователей меняются файлами на различных, в том числе и русскоговорящих хабах.</p>
  <p>Эта P2P сеть работает по принципу расшаривания ресурсов для всеобщего доступа. Каждый пользователь выделяет ряд файлов которыми хочет поделиться с обществом.</p>
@en
  <p><strong>DC++</strong> is a popular client software for the Direct Connect file sharing network. Most of the forks are made from this client.</p>
@endru
@endsection
