@extends('dcpp.software', [
  'meta_title' => trans('meta_title.dcpp.airdc'),
  'software_title' => trans('dcpp.airdc'),
  'software' => [
    ['version' => '3.41', 'id' => 156, 'size' => 48108816, 'dl_suffix' => ''],
    ['version' => '2.09', 'id' => 142, 'size' => 6915716, 'dl_suffix' => ''],
    ['version' => '2.07', 'id' => 131, 'dl_suffix' => ''],
  ],
  'software_screenshots' => [
    [
      'full' => 'https://img.ivacuum.ru/g/120207/1_nE5CZz1ute.png',
      'thumb' => 'https://img.ivacuum.ru/g/120207/s/1_nE5CZz1ute.png',
    ], [
      'full' => 'https://img.ivacuum.ru/g/120207/1_73UsJceBSs.png',
      'thumb' => 'https://img.ivacuum.ru/g/120207/s/1_73UsJceBSs.png',
    ], [
      'full' => 'https://img.ivacuum.ru/g/120207/1_oQUc7FeN89.png',
      'thumb' => 'https://img.ivacuum.ru/g/120207/s/1_oQUc7FeN89.png',
    ], [
      'full' => 'https://img.ivacuum.ru/g/120207/1_rGS8EGZEp0.jpg',
      'thumb' => 'https://img.ivacuum.ru/g/120207/s/1_rGS8EGZEp0.jpg',
    ],
  ],
  'developer_site' => 'http://airdcpp.net/',
])

@section('about_software')
@ru
  <p><strong>AirDC++</strong> — это клиент, основанный на <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>. Соответственно, он поддерживает многопотоковую, сегментную закачку и другие функции, приобретенные от <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a>, а также обладает приятным дизайном — крупными, красивыми кнопками, дружественным интерфейсом, но не имеет русского языка в стандартной поставке.</p>
@en
  <p><strong>AirDC++</strong> is based on <a class="link" href="{{ path('Dcpp@page', 'strongdc') }}">StrongDC++</a> and supports segmented downloads and many other features.</p>
@endru
@endsection
