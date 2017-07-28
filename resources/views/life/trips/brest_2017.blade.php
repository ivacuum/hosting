@extends('life.trips.base')

@section('content')
@ru
  <p>Пошли первые надписи на белорусском языке.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1887.jpg'])

@ru
  <p>Возле заправки.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1888.jpg'])

@ru
  <p>Зеленые горки. Зимой будет хорошо.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1894.jpg'])

@ru
  <p>Валюта поменялась, но примерная стоимость бензина осталась на российском уровне.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1895.jpg'])

@ru
  <p>Место для застолья.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1896.jpg'])

@ru
  <p>Пешеходный переход с фонарем.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1899.jpg'])

@ru
  <p>Немного улиц Бреста.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1902.jpg',
  'IMG_1903.jpg',
  'IMG_1904.jpg',
  'IMG_1918.jpg',
]])

@ru
  <p>Мост.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1915.jpg'])

@ru
  <p>День независимости Беларуси, оказывается, на дворе. Хорошо, что проскочили, пока не перекрыли улицы.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1917.jpg'])

@ru
  <p>Добрались до границы. Это уже вторая по счету. Первая оказалась грузовой (она севернее), поэтому пришлось ехать через Брест, чтобы попасть на границу для легковых автомобилей.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1920.jpg'])

@ru
  <p>3 часа ожидания дали понять, что Брест—Тересполь нужно обходить стороной. Куда лучше проходить границу Гродно—Белосток. Всегда можно <a class="link" href="http://gpk.gov.by">свериться с сайтом</a>, чтобы узнать обстановку на пограничных пунктах на текущий момент.</p>
@endlang

<a name="nebyaspeka"></a>
@ru
  <p>Небяспека — опасность. <a class="link" href="/life/minsk.2017#byaspeka">Бяспека</a> — безопасность.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1921.jpg'])
@endsection
