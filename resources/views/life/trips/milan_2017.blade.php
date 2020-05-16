@extends('life.trips.base')

@section('content')
@ru
  <p><a class="link" href="https://www.endomondo.com/users/6097438/workouts/1009514752">Трек маршрута</a> автобуса из Венеции. На подъезде к Милану был нехилый затор. Он слегка укоротил и без того короткий однодневный визит.</p>
@endru

@ru
  <p>Вход в метро.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3844.jpg'])

@ru
  <p>Схема станции.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3855.jpg'])

@ru
  <p>Станция на красной ветке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3843.jpg'])

@ru
  <p>Станция на зеленой ветке.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3898.jpg'])

@ru
  <p>Аэрофлот немало рекламируется заграницей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3893.jpg'])

@ru
  <p>Почтовые ящики.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3845.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3847.jpg',
  'IMG_3851.jpg',
  'IMG_3869.jpg',
  'IMG_3873.jpg',
  'IMG_3874.jpg',
  'IMG_3900.jpg',
]])

@ru
  <p>Большие автомобильные номера сзади.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3848.jpg'])

@ru
  <p>И маленькие спереди.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3849.jpg'])

@ru
  <p>Охрана порядка на площади усилена дополнительными нарядами полиции.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3856.jpg'])

@ru
  <p>Коллекция трамваев от современных до старых.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3857.jpg',
  'IMG_3858.jpg',
  'IMG_3862.jpg',
  'IMG_3863.jpg',
  'IMG_3864.jpg',
  'IMG_3865.jpg',
]])

@ru
  <p>Остановка трамвая.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3860.jpg'])

@ru
  <p>Переулок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3861.jpg'])

@ru
  <p>Фасады.</p>
@en
  <p>Facades.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3866.jpg',
  'IMG_3868.jpg',
  'IMG_3894.jpg',
  'IMG_3896.jpg',
]])

@ru
  <p>Парковка скутеров и мотоциклов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3876.jpg'])

@ru
  <p>Парк. В нем попалась очень забавная пара черепашек, представленная на видео ниже.</p>
@endru
<livewire:youtube title="Milan Turtles #1, September 2017" v="_hgdMwIKPYc"/>
<livewire:youtube title="Milan Turtles #2, September 2017" v="HJYn1RL64sk"/>
@include('tpl.pic-2x', ['pic' => 'IMG_3892.jpg'])

@ru
  <p>Питьевой фонтан.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3879.jpg'])

@ru
  <p>Главный железнодорожный вокзал.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3899.jpg'])

@ru
  <p>Мусорные пакеты натягивают как в Париже. Только распределение веса лучше — ровно висят.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3903.jpg'])

@ru
  <p>Платформа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3905.jpg'])

@ru
  <p>Отправление в Рим на скоростном поезде.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3910.jpg'])
@endsection
