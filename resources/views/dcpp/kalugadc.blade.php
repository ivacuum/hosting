@extends('dcpp.software', [
  'no_language_selector' => $locale === 'ru',

  'software_title' => trans('dcpp.kalugadc'),
  'software' => [
    ['version' => '', 'id' => 12, 'size' => 1861500, 'dl_suffix' => ''],
  ],
])

@section('about_software')
@ru
  <p>Этот клиент был разработан калужскими умельцами специально для работы в DC++ сети Домолинка. Клиент имеет соответствующую символику и уже настроен для работы с несколькими хабами этой сети. Клиент поддерживает	многопотоковую закачку, позволяет устанавливать ограничение на ширину канала отдачи и много других полезных функций.</p>

  <section>
    <h2>Установка и настройка</h2>
    <p>После установки клиентка вам необходимо будет указать ваш ник:</p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/091002/1_1aVMvTi73f.jpg', 'w' => 664, 'h' => 503])
    <p>А также указать папки, доступ к которым будет открыт для других пользователей:</p>
    @include('tpl.screenshot', ['pic' => 'https://img.ivacuum.ru/g/091002/1_aid11fD5AJ.jpg', 'w' => 657, 'h' => 500])
    <div>После этих настроек перезапустите программу и пользуйтесь <strong>Kaluga DC++</strong> с удовольствием!</div>
  </section>
@en
  <p><strong>Kaluga DC++</strong> is a DC++ client made for Domolink ISP in Kaluga.</p>
@endru
@endsection
