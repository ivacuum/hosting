@extends('life.trips.base')

@section('content')
@ru
  <p>В 7 утра еще в Калуге, в 11:30 вылет из Внуково, в 14 уже на Крестовском острове в Петербурге. И не такое устроишь, если время поджимает. Осуществить задуманное помог перелет из Москвы — всего час в воздухе.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0421.jpg'])

@ru
  <p>Февраль, зима, но солнечно и сухо. Люди не упускают шанс погонять на велосипеде, скейте или роликах.</p>
@en
  <p>February, winter, but it is sunny and dry. People don't miss the chance to cycle or skate.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0390.jpg'])

@ru
  <p>Еще велосипедист.</p>
@en
  <p>Another cyclist.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0398.jpg'])

@ru
  <p>СК Юбилейный — место предстоящего <a class="link" href="dreamtheater.2014.spb">концерта Дрим Театра</a>.</p>
@en
  <p>The place of <a class="link" href="dreamtheater.2014.spb">Dream Theater</a> gig.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0391.jpg'])

@ru
  <p>Подъезд.</p>
@en
  <p>Entrance hall.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0394.jpg'])

@ru
  <p>Сколько знаков пешеходного перехода видно?</p>
@en
  <p>How many pedestrian cross signs do you see?</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0389.jpg',
  'IMG_0395.jpg',
]])

@ru
  <p>Вовсю идет стройка.</p>
@en
  <p>Buildings are being constructed.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0397.jpg'])

@ru
  <p>Обилие граффити.</p>
@en
  <p>Lots of graffiti.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0399.jpg'])

@ru
  <p>Почта, телеграф, телефон.</p>
@en
  <p>Post, telegraph, telephone.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0400.jpg'])

@ru
  <p>След ледокола на Неве.</p>
@en
  <p>Icebreaker trail on the Neva river.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0409.jpg'])

@ru
  <p>Марсово поле.</p>
@en
  <p>Field of Mars.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0410.jpg'])

@ru
  <p>Панорамы.</p>
@en
  <p>Panoramas.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0412.jpg',
  'IMG_0414.jpg',
  'IMG_0415.jpg',
]])
@endsection
