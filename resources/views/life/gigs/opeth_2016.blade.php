@extends('life.gigs.base')

{{-- Ancienne Belgique --}}

@section('content')
@ru
  <p>Можно было подождать шведов в России, но их последний визит к нам датирован 2012 годом, а нового не ожидалось. Поэтому выбор пал на невиданный ранее Брюссель, дабы совместить приятное с полезным.</p>
@endlang

@ru
  <p>Расписание было заранее вывешено на сайте площадки и транслировалось на экране внутри клуба. Даже собственная запись выступления Opeth на диктофон показала, что ее длительность ровно два часа.</p>
  <table class="table-stats m-b-1">
    <tr>
      <td class="text-muted">19:00</td>
      <td>Открытие дверей</td>
    </tr>
    <tr>
      <td class="text-muted">19:30</td>
      <td>Sahg (разогрев)</td>
    </tr>
    <tr>
      <td class="text-muted">20:30</td>
      <td>Opeth</td>
    </tr>
    <tr>
      <td class="text-muted">22:30</td>
      <td>Окончание шоу</td>
    </tr>
  </table>
@endlang

@ru
  <p>Внутри не было гардероба в привычном понимании. Лишь сейфовые ячейки, которые в более сложном виде можно встретить на вокзалах. Закинутый внутрь один евро позволял закрыть замок и забрать ключ. Эдакое самообслуживание. Ячейка вместительная — комфортно брать одну хоть на четверых.</p>
@endlang

@ru
  <p>Все расчеты за напитки внутри клуба производились за жетоны, которые продавались в специальном терминале по 2,7 евро за штуку.</p>
@endlang

@ru
  <p>Билет на концерт на удивление оказался крайне дешевым — всего 31 евро. По одному евро с каждого билета шло на возможность посещения концерта людьми с ограниченными способностями.</p>
@endlang

@ru
  <p>Раммштайн в Берлине был дешевле, чем в Москве. В случае с Opeth скорее всего концерт в Москве тоже был бы дороже такового в Брюсселе.</p>
@endlang

<div class="row">
  <div class="col-md-7">
    @ru
      <p>Песен сыграли мало — сказывается их средняя продолжительность в десять минут. Зато охватили большинство выпущенных альбомов в рамках одного выступления.</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Sorceress</li>
      <li>Ghost of Perdition</li>
      <li>Demon of the Fall</li>
      <li>The Wilde Flowers</li>
      <li>Face of Melinda</li>
      <li>In My Time of Need</li>
      <li>Cusp of Eternity</li>
      <li>The Drapery Falls</li>
      <li>Heir Apparent</li>
      <li>The Grand Conjuration</li>
      <li>Deliverance</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/opeth.2016.11.17.jpg">
    </div>
  </div>
</div>
@endsection
