@extends('life.gigs.base')

@section('content')
@ru
  <p>Шоу Раммштайна можно смело рекомендовать увидеть всем хотя бы раз в жизни. И услышать какой отличный звук устраивают их звукачи на любой площадке.</p>
@endlang
<div class="row">
  <div class="col-md-7">
    @include('tpl.setlist-title')
    <ol>
      <li>Rammlied</li>
      <li>B********</li>
      <li>Waidmanns Heil</li>
      <li>Keine Lust</li>
      <li>Weißes Fleisch</li>
      <li>Feuer frei!</li>
      <li>Wiener Blut</li>
      <li>Frühling in Paris</li>
      <li>Ich tu dir weh</li>
      <li>Liebe ist für alle da</li>
      <li>Benzin</li>
      <li>Links 2-3-4</li>
      <li>Du hast</li>
      <li>Pussy</li>
      <li>Sonne</li>
      <li>Haifisch</li>
      <li>Ich will</li>
      <li>Engel</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/rammstein.2010.02.26.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись концерта:</p>
@endlang
<youtube title="Rammstein, St. Petersburg, 2010" v="KbUoLxHqM8M"></youtube>
@endsection
