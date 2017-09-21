@extends('life.trips.base')

@section('content')
@ru
  <p>Братислава — рельефный город.</p>
@en
  <p>Bratislava isn't flat for sure.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3567.jpg',
  'IMG_3569.jpg',
  'IMG_3570.jpg',
  'IMG_3573.jpg',
]])

@ru
  <p>Улицы старого города.</p>
@en
  <p>Old town's streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3549.jpg',
  'IMG_3560.jpg',
]])

@ru
  <p>Фасады зданий.</p>
@en
  <p>Buildings' facades.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3551.jpg',
  'IMG_3552.jpg',
  'IMG_3558.jpg',
  'IMG_3559.jpg',
  'IMG_3571.jpg',
]])

@ru
  <p>Указатели улиц.</p>
@en
  <p>Street signs.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3553.jpg'])

@ru
  <p>Мост с НЛО на крыше.</p>
@en
  <p>Bridge with UFO on top.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3564.jpg',
  'IMG_3565.jpg',
]])

@ru
  <p>Пешеходы идут по мосту на отдельном уровне ниже машин. Половина прохода отдана велосипедистам.</p>
@en
  <p>People cross the bridge on a separate level below cars. Half of the space is given to cyclists.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3575.jpg'])

@ru
  <p>Другой пример моста, но уже без машин.</p>
@en
  <p>Another bridge, but this one without cars.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3583.jpg',
  'IMG_3584.jpg',
  'IMG_3586.jpg',
]])

@ru
  <p>Панорама города.</p>
@en
  <p>City's panorama.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3574.jpg'])

@ru
  <p>Автомат по продаже билетов на общественный транспорт. Плох тем, что принимает только монеты.</p>
@en
  <p>Ticket vending machine. Sadly, it accepts only coins.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3541.jpg'])

@ru
  <p>Остановка трамвая.</p>
@en
  <p>Tram stop.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3542.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3534.jpg',
  'IMG_3535.jpg',
  'IMG_3536.jpg',
  'IMG_3537.jpg',
  'IMG_3538.jpg',
  'IMG_3539.jpg',
  'IMG_3543.jpg',
  'IMG_3587.jpg',
]])

@ru
  <p>Офис Амазона.</p>
@en
  <p>Amazon's office.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3540.jpg'])

@ru
  <p>Офис Есета.</p>
@en
  <p>Eset's office.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3576.jpg'])

@ru
  <p>Велопарковка.</p>
@en
  <p>Bicycle parking.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3577.jpg'])

@ru
  <p>Фрэши стоят не как на <a class="link" href="bali.2016">Бали</a>, но тоже сойдет.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3578.jpg'])

@ru
  <p>Поразительной привлекательности торговый центр. Прекрасный дизайн навигации уже подсказывал, что и остальное должно быть сделано добротно.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3582.jpg'])

@ru
  <p>Так и оказалось. Туалет был такой, что его хотелось фотографировать. К каждому крану пиктограмма.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3579.jpg'])

@ru
  <p>Перед туалетом чистка обуви и питьевой фонтан. Далее столик с тремя кожаными креслами, чтобы снаружи подождать нуждающихся.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3580.jpg'])

@ru
  <p>Лавочка с видом на Дунай.</p>
@en
  <p>Bench overlooking the Danube.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3585.jpg'])
@endsection
