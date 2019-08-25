@extends('life.gigs.base')

@section('content')
@ru
  <p>Шоу Раммштайна можно смело рекомендовать увидеть всем хотя бы раз в жизни. И услышать какой отличный звук устраивают их специалисты на любой площадке.</p>
  <p>Компанией из трех Александровичей, на лютом холоде на ступеньках СКК был употреблен виски с виноградом, найденный в торговом центре неподалеку. Не забуду как у меня глаза бегали внутри помещения, когда начали запускать. Думал уже развернут на досмотре. Хотя бы получилось согреться. До начала оставалось еще около часа — за время ожидания стал уже как огурчик.</p>
@endru
<div class="md:flex md:-mx-4">
  <div class="md:w-7/12 md:px-4">
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
      <li>
        <a class="link" href="https://www.youtube.com/watch?v=wOpuF5BiS1I">Benzin</a>
        @svg (heart)
      </li>
      <li>Links 2-3-4</li>
      <li>Du hast</li>
      <li>Pussy</li>
      <li>Sonne</li>
      <li>Haifisch</li>
      <li>Ich will</li>
      <li>Engel</li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="image-fit-viewport max-w-full sm:rounded" src="https://life.ivacuum.org/gigs/rammstein.2010.02.26.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись концерта.</p>
@endru
<youtube title="Rammstein 2010, St. Petersburg, Russia" v="KbUoLxHqM8M"></youtube>
@endsection
