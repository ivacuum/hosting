@extends('life.gigs.base')

{{-- Ancienne Belgique --}}

{{--
Highlights
- 19:30—21:10 Hello
- 28:20—30:37 Touring, happy audience
- 37:30—39:30 Play it again, second guitarist, didn't get paid of course, black metal band, immortal t-shirts, old sg guitar. На словах про гитару up here показывает, что держал ее на высоте груди и брынчал задорные песни. В блэк метал бэнде задорные песни! Best single without god ... nobody knows
- Дальше легкую часть трека Face of Melinda очень даже неплохо слышно
- 48:50—50:30 So many songs, so much shit too
- Дальше тоже легкий трек In My Time of Need, слышно хорошо. Слов ваще не знал ни одной песни, но тут на слух сходу разбирал, запоминал и потихоньку подпевал. И не зря запоминал
- 54:20—55:00 Вокалист говорит you sing it и уходит, после первой спетой нами строчки разводит руками: «это че за хрень сейчас была?» Типа все, на что вы способны?
- 1:14:05—1:16:36 Сложная песня с первого альбома, которую нынешним составом никогда не играли. Пытаются угодить публике. It's pretty heavy song, I think I even wrote it like specifically wanted it to be heavy to shut up a few motherfuckers have been complaining
- 1:27:05—1:28:56 Подошли к последней песне, буууууу. Выкрик на 1:27:34 и подражание. У нас нет песни с таким названием
- 1:41:50—1:44:50 Медиатор, представление участников, on shitloads of different types of keyboards, с 1:43:13 перечисляет элементы ударных, а ударник по ним бьет
--}}

{{-- Для собственных фотографий в тексте истории --}}
@php ($slug = "gigs/{$gig->slug}")

@section('content')
@ru
  <p>Можно было подождать шведов в России, но их последний визит к нам датирован 2012 годом, а нового не ожидалось. Поэтому выбор пал на невиданный ранее Брюссель, дабы совместить приятное с полезным.</p>
@endlang

@ru
  <p>Расписание было заранее вывешено на сайте площадки и транслировалось на экране внутри клуба. Даже собственная запись выступления Опет на диктофон показала, что ее длительность ровно два часа.</p>
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

@include('tpl.pic-2x', ['pic' => 'IMG_2444.jpg'])

@ru
  <p>Все расчеты за напитки внутри клуба производились за жетоны, которые продавались в специальном терминале по 2,7 евро за штуку.</p>
@endlang

@ru
  <p>Билет на концерт на удивление оказался крайне дешевым — всего 31 евро. По одному евро с каждого билета шло на возможность посещения концерта людьми с ограниченными способностями.</p>
@endlang

@ru
  <p><a class="link" href="/life/rammstein.2016.07">Раммштайн в Берлине</a> был дешевле, чем в Москве. В случае с Опет скорее всего концерт в Москве тоже был бы дороже такового в Брюсселе.</p>
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

@ru
  <p>Фотография из Фейсбука группы по завершении концерта.</p>
@endlang
@include('tpl.pic-arbitrary', ['pic' => '1.jpg', 'w' => 540, 'h' => 720])
@endsection
