@extends('life.trips.base')

@section('content')
<p lang="ru">Любимый южнокорейский напиток Милкис — газированное молоко. На Дальнем Востоке есть практически в каждом магазине. В Калуге встречается только в магазине <a class="link" href="https://krasnoeibeloe.ru/catalog/?q=милкис">Красное&Белое</a> в алюминиевых банках 0,25л.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0756.jpg'])

<p lang="ru">Управление ГИБДД. Машина без передних номеров куда привлекательнее смотрится.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0768.jpg'])

<p lang="ru">Приятное место для прогулки.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0781.jpg'])

<p lang="ru">Но нужно быть начеку, ибо хорошие тротуары — роскошь.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0784.jpg'])

<p lang="ru">Этот — хороший.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0774.jpg'])

<p lang="ru">А здесь тротуара вовсе нет. И это в центре города.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0779.jpg'])

<p lang="ru">В дождливую погоду передвижения ужесточаются.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0785.jpg'])

<p lang="ru">Соседние дома на разных улицах.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0778.jpg'])

<p lang="ru">С — кинотеатр. Кино зрители встречают волнительнее и эмоциональнее, чем в западной части России. От этого сеансы живее.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0787.jpg'])

<p lang="ru">За городом необъятные просторы.</p>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0791.jpg',
  'IMG_0804.jpg',
]])
@endsection
