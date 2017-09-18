@extends('dcpp.software', [
  'meta_title' => trans('meta_title.dcpp.kalugadc'),
  'software_title' => trans('dcpp.kalugadc'),
  'software' => [
    ['version' => '', 'id' => 12, 'size' => 1861500, 'dl_suffix' => ''],
  ],
])

@ru
  @section('i18n')
  @endsection
@endru

@section('about_software')
@ru
  <p>Этот клиент был разработан калужскими умельцами специально для работы в DC++ сети Домолинка. Клиент имеет соответствующую символику и уже настроен для работы с несколькими хабами этой сети. Клиент поддерживает	многопотоковую закачку, позволяет устанавливать ограничение на ширину канала отдачи и много других полезных функций.</p>

  <section>
    <h2 class="mt-0">Установка и настройка</h2>
    <p>После установки клиентка вам необходимо будет указать ваш ник:</p>
    <p><img class="screenshot" src="https://img.ivacuum.ru/g/091002/1_1aVMvTi73f.jpg" width="664" height="503"></p>
    <p>А также указать папки, доступ к которым будет открыт для других пользователей:</p>
    <p><img class="screenshot" src="https://img.ivacuum.ru/g/091002/1_aid11fD5AJ.jpg" width="657" height="500"></p>
    <p>После этих настроек перезапустите программу и пользуйтесь <strong>Kaluga DC++</strong> с удовольствием!</p>
  </section>
@en
  <p>DC++ client made for Domolink ISP in Kaluga.</p>
@endru
@endsection
