@extends('life.trips.base')

@section('content')
@ru
  <p>Любимый южнокорейский напиток Милкис — газированное молоко. На Дальнем Востоке есть практически в каждом магазине. В Калуге встречается только в магазине <a class="link" href="https://krasnoeibeloe.ru/catalog/?q=милкис">Красное&Белое</a> в алюминиевых банках 0,25л.</p>
@en
  <p>Favorite South Korean beverage — carbonated milk.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0756.jpg'])

@ru
  <p>Управление ГИБДД. Машина без передних номеров куда привлекательнее смотрится.</p>
@en
  <p>Car does look attractive without front license plate.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0768.jpg'])

@ru
  <p>Приятное место для прогулки.</p>
@en
  <p>Pleasant place for a walk.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0781.jpg'])

@ru
  <p>Но нужно быть начеку, ибо хорошие тротуары — роскошь.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0784.jpg'])

@ru
  <p>Этот — хороший.</p>
@en
  <p>This one is good.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0774.jpg'])

@ru
  <p>А здесь тротуара вовсе нет. И это в центре города.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0779.jpg'])

@ru
  <p>В дождливую погоду передвижения ужесточаются.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0785.jpg'])

@ru
  <p>Соседние дома на разных улицах.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0778.jpg'])

@ru
  <p>С — кинотеатр. Кино зрители встречают волнительнее и эмоциональнее, чем в западной части России. От этого сеансы живее.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0787.jpg'])

@ru
  <p>За городом необъятные просторы.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0791.jpg',
  'IMG_0804.jpg',
]])
@endsection
