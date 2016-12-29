@extends('dcpp.software', [
  'software_title' => trans('dcpp.airdc'),
  'software' => [
    ['version' => '2.09', 'id' => 142, 'size' => 6915716, 'dl_suffix' => ''],
    ['version' => '2.07', 'id' => 131, 'dl_suffix' => ''],
  ],
  'software_screenshots' => [
    [
      'full' => 'http://img.ivacuum.ru/g/120207/1_nE5CZz1ute.png',
      'thumb' => 'http://img.ivacuum.ru/g/120207/s/1_nE5CZz1ute.png',
    ], [
      'full' => 'http://img.ivacuum.ru/g/120207/1_73UsJceBSs.png',
      'thumb' => 'http://img.ivacuum.ru/g/120207/s/1_73UsJceBSs.png',
    ], [
      'full' => 'http://img.ivacuum.ru/g/120207/1_oQUc7FeN89.png',
      'thumb' => 'http://img.ivacuum.ru/g/120207/s/1_oQUc7FeN89.png',
    ], [
      'full' => 'http://img.ivacuum.ru/g/120207/1_rGS8EGZEp0.jpg',
      'thumb' => 'http://img.ivacuum.ru/g/120207/s/1_rGS8EGZEp0.jpg',
    ],
  ],
  'developer_site' => 'http://airdcpp.net/',
])

@section('about_software')
@ru
  <p><strong>AirDC++</strong> — это клиент, основанный на <a class="link" href="{{ action('Dcpp@page', 'strongdc') }}">StrongDC++</a>. Соответственно, он поддерживает многопотоковую, сегментную закачку и другие функции, приобретенные от <a class="link" href="{{ action('Dcpp@page', 'strongdc') }}">StrongDC++</a>, а также обладает приятным дизайном — крупными, красивыми кнопками, дружественным интерфейсом, но не имеет русского языка в стандартной поставке.</p>
@en
  <p><strong>AirDC++</strong> is based on <a class="link" href="{{ action('Dcpp@page', 'strongdc') }}">StrongDC++</a> and supports segmented downloads and many other features.</p>
@endlang
@endsection
