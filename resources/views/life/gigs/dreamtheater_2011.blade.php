@extends('life.gigs.base')

{{-- Крокус Сити Холл --}}

@section('content')
@ru
  <p>Из группы в 2010 ушел один из основателей и ударник Майк Портной. Была решительно непонятна дальнейшая судьба коллектива. Однако, музыканты нашли замену и ничуть не стали сбавлять темпы гастролей и выпуска новых записей.</p>
  <p>Ко второму визиту в Россию была подготовлена совершенно новая программа. Лишь Learning to Live уже исполнялась в <a class="link" href="dreamtheater.2009">прошлый раз</a>, но и то как часть большого микса в конце шоу. Такой огромный репертуар и разнообразие вызывают уважение.</p>
  <p>У Петруччи день рождения всего на сутки раньше моего. На сцене поздравляли его, а по пути домой наступил уже и мой.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/dreamtheater.2011.07.12.jpg'])
  <ol>
    <li>Under a Glass Moon</li>
    <li>These Walls</li>
    <li>Forsaken</li>
    <li>Endless Sacrifice</li>
    <li>Drum Solo</li>
    <li>The Ytse Jam</li>
    <li>Peruvian Skies</li>
    <li>The Great Debate</li>
    <li>On the Backs of Angels</li>
    <li>Happy Birthday <span class="text-sm text-muted">(Mildred J. Hill cover) (to John Petrucci)</span></li>
    <li>Caught in a Web</li>
    <li>Through My Words</li>
    <li>Fatal Tragedy</li>
    <li>The Count of Tuscany</li>
    <li>Learning to Live</li>
  </ol>
@endcomponent
@endsection
