@extends('life.gigs.base')

{{-- Razzmatazz 2 --}}

@section('content')
@ru
  <p>Будучи в Барселоне, заглянул в Твиттер. Там давно подписан на гитариста группы. Он несколькими часами ранее выложил фотку из Мадрида. Закрались мысли проверить где же они играют в ближайшие дни. Ха, тем же вечером у них по плану концерт в Барселоне. Вот так повезло! И билеты были в наличии всего по 30 евро.</p>
@endru
@ru
  <p>Местом проведения оказался клуб под названием Razzmatazz, и это слово даже имеет перевод с английского. Об этом узнал значительно позднее во время просмотра пятого сезона Черного зеркала, где во второй раз встретилось это слово. Там его перевели как спецэффекты, а Гугл считает, что это суета.</p>
@endru
@ru
  <p>Было испытано незнакомое ранее ощущение добраться до места проведения концерта за полчаса, потусить и вернуться домой за полчаса-час. Вот в таком шоколаде жители столиц и следующих самых населенных городов. Куда привычнее 3–4 часа добирать до площадки, а потом столько же обратно. Но лучше так с Калугой, чем находиться на Дальнем Востоке и кусать локти, что очень накладно посещать концерты.</p>
@endru
@ru
  <p>На испаноговорящую публику были большие надежды в плане активности и шума, но она их не оправдала. Стояли, общались, пили пивас, на призывы прыгать не реагировали. На кого же тогда надежда, кроме <a class="link" href="psy.2018">корейцев</a>? На чилийцев?</p>
@endru
<div class="md:flex md:-mx-4">
  <div class="mb-4 md:w-7/12 md:px-4">
    @include('tpl.setlist-title')
    <ol>
      <li>TRRR - FCKN - HTLR</li>
      <li>Labyrinth</li>
      <li>Träumst Du</li>
      <li>Jetzt oder nie</li>
      <li>Der neue Gott</li>
      <li>Mein Herz</li>
      <li>Das weisse Licht</li>
      <li>Tausend Mann und ein Befehl</li>
      <li>Niemand</li>
      <li>Kein Liebeslied</li>
      <li>Auf Kurs</li>
      <li>Fieber</li>
      <li>Das letzte Streichholz</li>
      <li>Gott ist ein Popstar</li>
      <li>Gekreuzigt</li>
      <li>Alles aus Liebe</li>
      <li>Im Namen des Vaters</li>
      <li>Jede Reise hat ein Ende</li>
      <li>Kleinstadtboy</li>
      <li>Sandmann</li>
      <li>Augen auf!</li>
      <li>Mein Schatz</li>
      <li>Als wärs das letzte Mal</li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="sm:rounded" src="https://life.ivacuum.org/gigs/oomph.2018.09.14.jpg">
    </div>
  </div>
</div>
@endsection
