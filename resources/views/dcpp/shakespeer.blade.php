@extends('dcpp.software', [
  'software_title' => trans('dcpp.shakespeer'),
  'software' => [
    ['version' => '0.9.2', 'id' => 33, 'size' => 3159067, 'icon' => 'apple', 'dl_suffix' => ''],
  ],
  'software_screenshots' => $locale === 'en' ? [
    [
      'full' => 'https://img.ivacuum.ru/g/091002/1_Km1HDRuJH0.png',
      'thumb' => 'https://img.ivacuum.ru/g/091002/t/1_Km1HDRuJH0.png',
    ],
  ] : [],
])

@section('about_software')
@ru
  <p><strong>ShakesPeer</strong> — это один из немногих клиентов для работы в сети DC++ для операционной системы macOS.</p>

  <h3 class="mt-5">Примечание</h3>
  <p>Если после установки клиента у вас не будут отображатся русские шрифты, вам необходимо будет поменять кодировку для данного хаба в настройках, как показано на изображении ниже.</p>
  <p><img class="img-fluid" src="https://img.ivacuum.ru/g/091002/1_Km1HDRuJH0.png" width="760" height="432"></p>
@en
  <p><strong>ShakesPeer</strong> is a popular macOS DC++ client software. At least it was popular a decade ago when it was actively developed. These days it's better to check <a class="link" href="{{ path('Dcpp@page', 'jucydc') }}">Jucy DC++</a> multiplatform client.</p>
@endru
@endsection
