@extends('life.trips.base')

@section('content')
@ru
  <p>Первая очная ставка с двумя коллегами в бизнес-центре Регус почти за 15 месяцев трудоустройства.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5739.jpg'])

@ru
  <p>Обеденная зона.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5740.jpg'])

@ru
  <p>Теремок теперь открылся сбоку от Европейского — проще вкусить русской кухни перед поездом и после него, так как более не нужно подниматься на фуд-корт на четвертом этаже торгового центра Европейский.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5742.jpg'])

@ru
  <p>Меры профилактики коронавируса на Киевском вокзале. Памятки встречались и в других местах по городу. Подстава, если с вирусом не справятся до лета и придется отказаться от поездки в Корею на <a class="link" href="psy.2019.07">водное шоу</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5743.jpg'])

@ru
  <p>Навигация на вокзале.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5744.jpg'])

@ru
  <p>Ранее на таком поезде не раз доводилось ездить в сторону аэропорта Жуковский, а теперь состав РЭКС перебрался на калужское направление.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5745.jpg',
  'IMG_5746.jpg',
]])

@ru
  <p>Уши на подголовниках способствуют сну. Ранее в экспрессах они были только в первом классе. Теперь есть и во втором.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5747.jpg'])

@ru
<p>Не раз сталкивался с проблемой пользования вай-фаем в сети московского транспорта MT_FREE — нельзя использовать собственные днс-серверы. Установишь себе какой-нибудь 8.8.8.8 Гугла и потом гадаешь почему бесплатный вай-фай не работает. Приходилось пользоваться исключительно настройками, предоставляемыми самой сетью MT_FREE. И самое забавное, что РЭКС выдал тот самый 8.8.8.8. И потому бесплатный вай-фай не&nbsp;заработал.</p>
@endru
@endsection
