@extends('life.gigs.base')

{{-- Крокус Сити Холл --}}

@section('content')
@ru
  <p>Седьмое выступление в Москве немцы устроили с симфоническим оркестром. Заметил около пульта звукорежиссера здоровую видеокамеру. Задавался вопросом будут ли транслировать на экраны шоу для балконов. Осмотрелся — экраны по бокам действительно были, но выключенные. Разгадка оказалась куда интереснее — после трети песен вокалист Деро сообщил, что концерт снимают для последующего выпуска на ДВД. Конечно, в 2018 уже несколько странно в таком формате выпускать видео, но так проще всего донести до публики сам факт съемки концерта.</p>
@endru
@ru
  <p>В сетлисте можно заметить, что три песни повторяются. Niemand должна была стать последней в сете, но из-за технических заминок три песни пришлось сыграть заново. До этого в <a class="link" href="oomph.2012">2012 году</a> дважды исполнялась Augen auf.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/oomph.2018.09.14.jpg'])
  <ol>
    <li>Gekreuzigt</li>
    <li>Sandmann</li>
    <li>Träumst Du</li>
    <li>Labyrinth</li>
    <li>Jede Reise hat ein Ende</li>
    <li>Auf Kurs</li>
    <li>Als wärs das letzte Mal</li>
    <li>Unter diesem Mond</li>
    <li>Das weisse Licht</li>
    <li>Der neue Gott</li>
    <li>Alles aus Liebe</li>
    <li>Jetzt oder nie</li>
    <li>Gott ist ein Popstar</li>
    <li>Augen auf!</li>
    <li>Niemand</li>
    <li>Auf Kurs</li>
    <li>Unter diesem Mond</li>
    <li>Labyrinth</li>
  </ol>
@endcomponent

@ru
  <p>Видеозапись выступления.</p>
@en
  <p>Video of the show.</p>
@endru
<livewire:youtube title="Oomph 2018, Moscow, Russia" v="Nv-LLFJYvOI"/>
@endsection
