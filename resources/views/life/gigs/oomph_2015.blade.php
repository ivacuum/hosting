@extends('life.gigs.base')

{{-- Ray Just Arena --}}

@section('content')
@ru
  <p>Если в <a class="link" href="oomph.2012">2012 году</a> немцы начали тур с Москвы, то в этот раз они в столице его закончили, то есть могли свободно задержаться на афтепати. Впрочем, мы получили бонус и во время шоу — плюс две песни относительно других концертов тура, причем исполненные одним вокалистом. В самом конце забавно было наблюдать по мониторным наушникам его намерения — если он их надевал, то собирался начать следующую песню.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/oomph.2015.11.04.jpg'])
  <ol>
    <li>Alles aus Liebe</li>
    <li>Labyrinth</li>
    <li>Träumst Du</li>
    <li>Mein Schatz</li>
    <li>Das weisse Licht</li>
    <li>Mein Herz</li>
    <li>Der neue Gott</li>
    <li>Unzerstörbar</li>
    <li>Als wärs das letzte Mal</li>
    <li>Wunschkind</li>
    <li>Jede Reise hat ein Ende</li>
    <li>Bis der Spiegel zerbricht</li>
    <li>Jetzt oder nie</li>
    <li>Niemand</li>
    <li>Mitten ins Herz</li>
    <li>Unter diesem Mond</li>
    <li>Auf Kurs</li>
    <li>Sandmann</li>
    <li>Gekreuzigt</li>
    <li>Augen auf!</li>
    <li>Kleinstadtboy</li>
    <li>Gott ist ein Popstar</li>
    <li>Dankeschön</li>
    <li>The Power of Love / Das letzte Streichholz / Fieber</li>
  </ol>
@endcomponent

@ru
  <p>Видеозапись выступления.</p>
@endru
<livewire:youtube title="Oomph 2015, Moscow, Russia" v="FfETlcHkmCU"/>
@endsection
