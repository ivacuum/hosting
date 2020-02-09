@extends('life.gigs.base')

{{-- Arena Moscow --}}

@section('content')
@ru
  <p>Неожиданно тур в поддержку нового альбома начался в Москве. Сет был неизвестен, непонятно к чему готовиться. Сюрприз был преподнесен уже на пятой песне — ее дали исполнить залу без музыкального сопровождения. Задача оказалась непростой, так как альбом только-только вышел, и к такому предложению мы не были готовы. Еще Augen auf дважды исполнили.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/oomph.2012.05.24.jpg'])
  <ol>
    <li>Unzerstörbar</li>
    <li>Beim ersten Mal tut's immer weh</li>
    <li>Träumst Du</li>
    <li>Unsere Rettung</li>
    <li>
      Seemannsrose
      <span class="text-sm text-muted">(A Capella)</span>
    </li>
    <li>Fieber</li>
    <li>Wer schön sein will muss leiden</li>
    <li>Das weisse Licht</li>
    <li>
      Augen auf!
      <span class="text-sm text-muted">(A Capella with girl from crowd)</span>
    </li>
    <li>Mitten ins Herz</li>
    <li>Zwei Schritte Vor</li>
    <li>
      Sex hat keine Macht
      <span class="text-sm text-muted">(Acoustic)</span>
    </li>
    <li>Auf Kurs
      <span class="text-sm text-muted">(Acoustic)</span>
    </li>
    <li>Bis der Spiegel zerbricht</li>
    <li>Revolution</li>
    <li>Mein Schatz</li>
    <li>Niemand</li>
    <li>Gekreuzigt</li>
    <li>Labyrinth</li>
    <li>Gott ist ein Popstar</li>
    <li>Augen auf!</li>
    <li>Sandmann</li>
    <li>
      The Power of Love
      <span class="text-sm text-muted">(Frankie Goes to Hollywood cover) (A Capella)</span>
    </li>
  </ol>
@endcomponent

@ru
  <p>Видеозапись выступления.</p>
@endru
<youtube title="Oomph 2012, Moscow, Russia" v="6WVcvgTBrUk"></youtube>
@endsection
