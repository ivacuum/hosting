@extends('life.trips.base')

@section('content')
@ru
  <p>Главная цель визита — фестиваль <a class="link" href="rammstein.2016.06">Максидром</a>.</p>
@en
  <p>Main goal of the visit was <a class="link" href="rammstein.2016.06">Maxidrom</a> festival.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0618.jpg'])

@ru
  <p>Попутно опробован <a class="link" href="http://pandapark.org/">веревочный парк</a> — прекрасная возможность полазать по переправам над землей.</p>
@endlang

@ru
  <p>Современная Крымская набежерная.</p>
@en
  <p>Modern embankment Crimean.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0612.jpg'])

@ru
  <p>Есть где всегда укрыться в теньке.</p>
@en
  <p>There is always a place to hide in the shade.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0613.jpg'])

@ru
  <p>Набережная плавно переходит в Парк Горького.</p>
@en
  <p>Embankment transitions into Gorky Park.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0614.jpg'])

@ru
  <p>Волны от проходящих судов омывают ступени.</p>
@en
  <p>Waves from passing ships wash the stairs.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0615.jpg'])

@ru
  <p>Лежаки вдоль Москвы-реки не простаивают.</p>
@en
  <p>Sunbeds along Moskva river don't stay vacant.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0616.jpg'])

@ru
  <p>Куда прикладывать ключ от домофона? Ночью впритык к двери понадобилось не менее минуты, чтобы найти.</p>
@en
  <p>What is the place for the intercom key? Standing right in front of the door, it took at least one minute to find it at night.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0619.jpg'])

@ru
  <p>Пешеходные пространства развиваются.</p>
@en
  <p>Pedestrian zones are getting better.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0623.jpg',
  'IMG_0626.jpg',
]])

@ru
  <p>Еще в <a class="link" href="msk.2014.12#triumph">декабре 2014</a> Триумфальная площадь вовсю реконструировалась. Теперь она стала пешеходной. От желающих покачаться на качелях нет отбоя.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0627.jpg',
  'IMG_0628.jpg',
]])

@ru
  <p>Совершенно другие впечатления от Москвы, когда приезжаешь в нее на несколько дней. Нет спешки на вечерний транспорт, вещи оставлены дома. Позитива куда больше. Еще и мест погулять в центре значительно прибавляется с каждым годом.</p>
@endlang
@include('tpl.airbnb_coupon', ['city' => 'Москве', 'coupon' => 'MOSCOU2015'])
@endsection
