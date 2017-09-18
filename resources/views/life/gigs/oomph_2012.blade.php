@extends('life.gigs.base')

{{-- Arena Moscow --}}

@section('content')
@ru
  <p>Неожиданно тур в поддержку нового альбома начался в Москве. Сет был неизвестен, непонятно к чему готовиться. Сюрприз был преподнесен уже на пятой песне — ее дали исполнить залу без музыкального сопровождения. Задача оказалась непростой, так как альбом только-только вышел, и к такому предложению мы не были готовы. Еще Augen auf дважды исполнили.</p>
@endru
<div class="row">
  <div class="col-md-7">
    @include('tpl.setlist-title')
    <ol>
      <li>Unzerstörbar</li>
      <li>Beim ersten Mal tut's immer weh</li>
      <li>Träumst Du</li>
      <li>Unsere Rettung</li>
      <li>
        Seemannsrose
        <small class="text-muted">(A Capella)</small>
      </li>
      <li>Fieber</li>
      <li>Wer schön sein will muss leiden</li>
      <li>Das weisse Licht</li>
      <li>
        Augen auf!
        <small class="text-muted">(A Capella with girl from crowd)</small>
      </li>
      <li>Mitten ins Herz</li>
      <li>Zwei Schritte Vor</li>
      <li>
        Sex hat keine Macht
        <small class="text-muted">(Acoustic)</small>
      </li>
      <li>Auf Kurs
        <small class="text-muted">(Acoustic)</small>
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
        <small class="text-muted">(Frankie Goes to Hollywood cover) (A Capella)</small>
      </li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/oomph.2012.05.24.jpg">
    </div>
  </div>
</div>

@ru
  <p class="mb-1">Видеозапись выступления.</p>
@endru
<youtube title="Oomph 2012, Moscow, Russia" v="6WVcvgTBrUk"></youtube>
@endsection
