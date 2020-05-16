@extends('life.trips.base')

@section('content')
@ru
  <p>Информативное объяснение стройки.</p>
@en
  <p>Good explanation of what's being constructed. "Subway is growing! The first train from Petrovsky park station is departing in late 2015."</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0197.jpg'])

@ru
  <p>Хитрец избегает оплаты за парковку.</p>
@en
  <p>Sneaky driver avoids parking payment.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0198.jpg'])

@ru
  <p>На пути в Государственный Кремлевский дворец — он справа от башни.</p>
@en
  <p>On the way to the State Kremlin Palace, it's to the right of the tower.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0199.jpg'])

@ru
  <p>Внутри <abbr title="Государственного Кремлевского дворца">ГКД</abbr>.</p>
@en
  <p>Inside the <abbr title="State Kremlin Palace">SKP</abbr>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0201.jpg'])

@ru
  <p>Кульминация вечера — предпоказ фильма Metallica: Through the Never. Приехали только ударник и басист. В лучших традициях знаменитостей <del>опоздали</del> задержались на пару часов. Красная ковровая дорожка, все как полагается. Ведущим был Иван Охлобыстин, слышно его было прекрасно во всем зале даже без микрофона. Зрители первых рядов получили возможность задать участникам группы вопросы, большинство из которых, впрочем, было ни о чем. Фильм показывали на английском языке с субтитрами, давно хотелось увидеть фильм в кино в таком формате. Во время самого показа по залу ходила охрана и препятствовала съемке. Звук в зале был потрясающий — очень близкий к <a class="link" href="metallica.2008">концертному</a>. Довелось позднее сравнить со звуком в кинотеатре в Калуге. В последнем уши хотелось скорей заткнуть чем-нибудь или выбежать из зала — хорошо, что я на минуту всего в зал заглянул. Кстати, на предпоказе была 2D версия, а в широкий прокат фильм вышел в 3D.</p>
@en
  <p>The culmination of the evening was presentation of the movie Metallica: Through the Never. Just band's drummer and bassist were there. They were late for the start for few hours like most of the celebrities do. Red carpet — all as it should be. The movie was streamed in English with Russian subtitles, I always wanted to watch a movie in this format in the cinema. Sound in Kremlin palace was outstanding, very close to the <a class="link" href="metallica.2008">concert</a> one. By the way, the movie was presented in 2D that day, but later in the cinemas it was available only in 3D.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0203.jpg',
  'IMG_0204.jpg',
  'IMG_0205.jpg',
]])

@ru
  <p>В определенный момент у переводчика возникли трудности с объяснением сложных оборотов речи Охлобыстина, это можно увидеть в видео ниже.</p>
  <livewire:youtube title="Презентация" v="FP28g9HijzQ"/>
@en
  <p>It was difficult for the translator to explain host's question to the band's members at some point. It can be seen in the video below.</p>
  <livewire:youtube title="Presentation" v="FP28g9HijzQ"/>
@endru

@ru
  <livewire:youtube title="Песня One из фильма" v="tbFZO1V5hrE"/>
@en
  <livewire:youtube title="Song 'One' from the movie" v="tbFZO1V5hrE"/>
@endru
@endsection
