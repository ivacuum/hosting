@extends('life.gigs.base')

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>20 часов туда, 15 часов на месте и 24 часа обратно. Столько времени длился автобусный тур из Москвы на фестиваль Рок над Волгой в Самарской области.</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Ich tu dir weh</li>
      <li>Wollt ihr das Bett in Flammen sehen?</li>
      <li>Keine Lust</li>
      <li>Sehnsucht</li>
      <li>Asche zu Asche</li>
      <li>Feuer frei!</li>
      <li>Mein Teil</li>
      <li>Ohne dich</li>
      <li>Wiener Blut</li>
      <li>Du riechst so gut</li>
      <li>Benzin</li>
      <li>Links 2-3-4</li>
      <li>Du hast</li>
      <li>Bück dich</li>
      <li>Ich will</li>
      <li>Mein Herz brennt</li>
      <li>Sonne</li>
      <li>Pussy</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/rammstein.2013.06.08.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись концерта.</p>
@endlang
<div class="js-lazy" data-lazy-type="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/watch?v=enTp6hq2Dqw"></a>
</div>
@endsection
