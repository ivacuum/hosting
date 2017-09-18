@extends('life.trips.base')

@section('content')
@ru
  <p>Из Москвы в Эмираты летает прекрасная местная авиакомпания Этихад. Алюминиевые приборы для еды заслуживают отдельного упоминания. Розетки на борту <a class="link" href="http://www.iec.ch/worldplugs/typeG.htm">британские</a>, также есть USB для мобильных устройств. Внутри самолета было холодно, как и на всей остальной цепочке азиатских рейсов. Благо, были пледы для каждого пассажира.</p>
@en
  <p>A splendid local aircompany Etihad flies from Moscow to UAE.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3132.jpg'])

@ru
  <p>Весь полет на судне доступна для просмотра внешняя камера. Так выглядит взлетно-посадочная полоса ночью.</p>
@en
  <p>Plane's external camera is available all flight long. That's how runway looks at night.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3137.jpg'])

@ru
  <p>Улей в аэропорту.</p>
@en
  <p>The hive in the airport.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3134.jpg'])

@ru
  <p>Э-э-э. На что я подписался?</p>
@en
  <p>Um, what have I accepted?</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'accept.png', 'w' => 1000, 'h' => 279])
@endsection
