@extends('life.trips.base')

@section('content')
@ru
  <p>«Добро пожаловать в Казань, местное время 12:38» — что-то пошло не по плану, ведь самолет должен был совершить посадку в Самаре. Аэропорт Курумоч не дал посадку, пилот немного покружил над ним и улетел на запасной аэродром в Татарстан.</p>
@en
  <p>"Ladies and gentlemen, welcome to Kazan, local time is 12:38pm." Well, something went wrong, because the plane should have landed in Samara.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'dick.png', 'w' => 424, 'h' => 316])

@ru
  <p>По данным flightradar24 полет закончился где-то в Каюках. Вот уж, действительно, каюк.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'kayuk.png', 'w' => 215, 'h' => 128])

@ru
  <p>В Казани заправились и полетели обратно в Самару. В итоге полуторачасовой полет растянулся на 3,5 часа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0537.jpg'])

@ru
  <p>Самара — город огромных расстояний и дорог, город для автомобилей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0547.jpg'])

@ru
  <p>Где еще такую огромную опору линии электропередач встретишь? Причем прямо в парке возле жилых домов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0552.jpg'])

@ru
  <p>Гигантских размеров красивая набережная. На обход может уйти не один час.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0562.jpg',
  'IMG_0563.jpg',
  'IMG_0565.jpg',
  'IMG_0566.jpg',
  'IMG_0570.jpg',
]])

@ru
  <p>Парков много, они большие, в них бывают дорожки для велосипедистов. Вообще велосипед отличный способ передвижения по городу. Плюс есть компании, которые уйму туристического снаряжения выдают в прокат. За велик, например, в районе 500 ₽ в сутки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0587.jpg'])

@ru
  <p>Фонтан, переходящий в Монумент Славы.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0582.jpg'])

@ru
  <p>Рай для любителя сокращений.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0593.jpg'])

@ru
  <p>Рай для любителя тополиного пуха. Ад для аллергика.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0599.jpg'])

@ru
  <p>Попадаются хорошие места для прогулок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0541.jpg'])

@ru
  <p>Пешеходная улица.</p>
@en
  <p>Pedestrian street.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0573.jpg'])

@ru
  <p>Смотровая площадка.</p>
@en
  <p>Observation deck.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0581.jpg',
  'IMG_0580.jpg',
]])

@ru
  <p>Деревьям дают спокойно и долго расти, как в <a class="link" href="kirov-klg.2016#trees">Кирове</a>. В той же <a class="link" href="kaluga">Калуге</a> часто пилят ветки, чтобы не мешали троллейбусным проводам и чтобы больше света попадало в квартиры домов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0583.jpg'])

@ru
  <p>Закат.</p>
@en
  <p>Sunset.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0550.jpg'])

@ru
  <p>За 3 неполных дня пройдено пешком более 50 км и проехано на велосипеде 32 км. Даже поход за продуктами порой растягивался на пару-тройку километров. Может поэтому местные жители в большинстве своем так хорошо выглядят?</p>
@endru
@endsection
