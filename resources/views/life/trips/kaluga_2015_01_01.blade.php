@extends('life.trips.base')

@section('content')
@ru
  <p>Здорово каждый новый год встречать новым образом или в новом месте. В последний момент поступило предложение собрать <a class="link" href="http://www.lego.com/ru-ru/technic/products/42030-remotecontrolled-volvo-l350f-wheel-loader">автопогрузчик Вольво из конструктора Лего</a>. Это была огромная коробка с 1 636 деталями и инструкцией более чем на 300 страниц. Предварительный прогноз в виде 3 минут на страницу обнадеживал — предстояло 15 часов сборки. На деле же понадобилось немногим более 7 часов. Полученная машина и ее ковш управляются с пульта, который тоже собирается из деталек.</p>
@endlang

@ru
  <p>Изменение содержимого стола в процессе сборки.</p>
@en
  <p>Table's content changes while assembling.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1378.jpg',
  'IMG_1380.jpg',
  'IMG_1382.jpg',
  'IMG_1386.jpg',
  'IMG_1389.jpg',
  'IMG_1391.jpg',
  'IMG_1397.jpg',
]])

@ru
  <p>Модель обрастала деталями.</p>
@en
  <p>Model is growing with parts.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1381.jpg',
  'IMG_1388.jpg',
  'IMG_1392.jpg',
  'IMG_1393.jpg',
  'IMG_1396.jpg',
  'IMG_1398.jpg',
  'IMG_1400.jpg',
  'IMG_1401.jpg',
  'IMG_1402.jpg',
  'IMG_1403.jpg',
  'IMG_1405.jpg',
]])
@endsection
