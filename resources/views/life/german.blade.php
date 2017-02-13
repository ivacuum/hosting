<?php \Breadcrumbs::push(trans('life.german')); ?>

@extends('life.base', [
  'meta_title' => trans('life.german'),
])

@ru
  @section('i18n')
  @endsection
@endlang

@section('content')
<h3 class="mt-0">{{ trans('life.german') }}</h3>
@ru
  <p class="mb-5">Конспект информации, освоенной во время изучения языка.</p>
@endlang

@ru
  <h3>Алфавит и произношение</h3>
  <div class="cities-columns">
    <div class="city-entry ml-0 pb-2">A <span class="text-muted">[a:]</span></div>
    <div class="city-entry ml-0 pb-2">B <span class="text-muted">[be:]</span></div>
    <div class="city-entry ml-0 pb-2">C <span class="text-muted">[tse:]</span> ц, к, ч</div>
    <div class="city-entry ml-0 pb-2">D <span class="text-muted">[de:]</span></div>
    <div class="city-entry ml-0 pb-2">E <span class="text-muted">[e:]</span></div>
    <div class="city-entry ml-0 pb-2">F <span class="text-muted">[ef]</span></div>
    <div class="city-entry ml-0 pb-2">G <span class="text-muted">[ge:]</span></div>
    <div class="city-entry ml-0 pb-2">H <span class="text-muted">[ha:]</span></div>
    <div class="city-entry ml-0 pb-2">I <span class="text-muted">[i:]</span></div>
    <div class="city-entry ml-0 pb-2">J <span class="text-muted">[jot:]</span> й</div>
    <div class="city-entry ml-0 pb-2">K <span class="text-muted">[ka:]</span></div>
    <div class="city-entry ml-0 pb-2">L <span class="text-muted">[el]</span> ль</div>
    <div class="city-entry ml-0 pb-2">M <span class="text-muted">[em]</span></div>
    <div class="city-entry ml-0 pb-2">N <span class="text-muted">[en]</span></div>
    <div class="city-entry ml-0 pb-2">O <span class="text-muted">[o:]</span></div>
    <div class="city-entry ml-0 pb-2">P <span class="text-muted">[pe:]</span></div>
    <div class="city-entry ml-0 pb-2">Q <span class="text-muted">[ku:]</span></div>
    <div class="city-entry ml-0 pb-2">R <span class="text-muted">[e:a]</span></div>
    <div class="city-entry ml-0 pb-2">S <span class="text-muted">[es]</span> з,ш</div>
    <div class="city-entry ml-0 pb-2">T <span class="text-muted">[te]</span></div>
    <div class="city-entry ml-0 pb-2">U <span class="text-muted">[u:]</span></div>
    <div class="city-entry ml-0 pb-2">V <span class="text-muted">[fau]</span> ф</div>
    <div class="city-entry ml-0 pb-2">W <span class="text-muted">[ve:]</span></div>
    <div class="city-entry ml-0 pb-2">X <span class="text-muted">[iks]</span> кс</div>
    <div class="city-entry ml-0 pb-2">Y <span class="text-muted">['ypsilon]</span> й</div>
    <div class="city-entry ml-0 pb-2">Z <span class="text-muted">[tset]</span> ц</div>
    <div class="city-entry ml-0 pb-2">Ä <span class="text-muted">[e:]</span> ё</div>
    <div class="city-entry ml-0 pb-2">Ö <span class="text-muted">[ø:]</span> ё</div>
    <div class="city-entry ml-0 pb-2">Ü <span class="text-muted">[y:]</span> ю</div>
    <div class="city-entry ml-0 pb-2">ß <span class="text-muted">[es'tset]</span> с</div>
  </div>

  <h3>Дифтонги</h3>
  <div class="cities-columns">
    <div class="city-entry ml-0 pb-2">ai, ei <span class="text-muted">[ай]</span></div>
    <div class="city-entry ml-0 pb-2">ie <span class="text-muted">[и:]</span></div>
    <div class="city-entry ml-0 pb-2">ig <span class="text-muted">[ихь]</span></div>
    <div class="city-entry ml-0 pb-2">eu, äu <span class="text-muted">[ой]</span></div>
    <div class="city-entry ml-0 pb-2">au <span class="text-muted">[ао]</span></div>
    <div class="city-entry ml-0 pb-2">sch <span class="text-muted">[ш]</span></div>
    <div class="city-entry ml-0 pb-2">tsch <span class="text-muted">[ч]</span></div>
    <div class="city-entry ml-0 pb-2">st <span class="text-muted">[шт]</span></div>
    <div class="city-entry ml-0 pb-2">sp <span class="text-muted">[шп]</span></div>
    <div class="city-entry ml-0 pb-2">ph <span class="text-muted">[ф]</span></div>
    <div class="city-entry ml-0 pb-2">rh <span class="text-muted">[р]</span></div>
    <div class="city-entry ml-0 pb-2">th, dt <span class="text-muted">[т]</span></div>
    <div class="city-entry ml-0 pb-2">tz, ts <span class="text-muted">[ц]</span></div>
    <div class="city-entry ml-0 pb-2">ng <span class="text-muted">[η]</span></div>
    <div class="city-entry ml-0 pb-2">nk <span class="text-muted">[ηк]</span></div>
    <div class="city-entry ml-0 pb-2">ck <span class="text-muted">[к]</span></div>
    <div class="city-entry ml-0 pb-2">qu <span class="text-muted">[кв]</span></div>
    <div class="city-entry ml-0 pb-2">ch <span class="text-muted">[х]</span> Buch</div>
    <div class="city-entry ml-0 pb-2">ch <span class="text-muted">[хь]</span> ich</div>
    <div class="city-entry ml-0 pb-2">ch <span class="text-muted">[к]</span> sechs</div>
    <div class="city-entry ml-0 pb-2">ch <span class="text-muted">[ш]</span> Chef</div>
    <div class="city-entry ml-0 pb-2">ch <span class="text-muted">[ч]</span> checken</div>
  </div>

  <h3>Числа</h3>
  <?php
  $entries = [
    ['ru' => 1, 'de' => 'eins'],
    ['ru' => 2, 'de' => 'zwei'],
    ['ru' => 3, 'de' => 'drei'],
    ['ru' => 4, 'de' => 'vier'],
    ['ru' => 5, 'de' => 'fünf'],
    ['ru' => 6, 'de' => 'sechs'],
    ['ru' => 7, 'de' => 'sieben'],
    ['ru' => 8, 'de' => 'acht'],
    ['ru' => 9, 'de' => 'neun'],
    ['ru' => 10, 'de' => 'zehn'],
    ['ru' => 11, 'de' => 'elf'],
    ['ru' => 12, 'de' => 'zwölf'],
    ['ru' => 13, 'de' => 'dreizehn'],
    ['ru' => 14, 'de' => 'vierzehn'],
    ['ru' => 15, 'de' => 'fünfzehn'],
    ['ru' => 16, 'de' => 'sechzehn'],
    ['ru' => 17, 'de' => 'siebzehn'],
    ['ru' => 18, 'de' => 'achtzehn'],
    ['ru' => 19, 'de' => 'neunzehn'],
    ['ru' => 20, 'de' => 'zwanzig'],
    ['ru' => 30, 'de' => 'dreißig'],
    ['ru' => 40, 'de' => 'vierzig'],
    ['ru' => 47, 'de' => 'siebenundvierzig'],
    ['ru' => 50, 'de' => 'fünfzig'],
    ['ru' => 60, 'de' => 'sechzig'],
    ['ru' => 69, 'de' => 'neunundsechzig'],
    ['ru' => 70, 'de' => 'siebzig'],
    ['ru' => 80, 'de' => 'achtzig'],
    ['ru' => 90, 'de' => 'neunzig'],
    ['ru' => 100, 'de' => 'einhundert'],
    ['ru' => 200, 'de' => 'zweihundert'],
    ['ru' => 300, 'de' => 'dreihundert'],
    ['ru' => 743, 'de' => 'siebenhundertdreiundvierzig'],
    ['ru' => 1000, 'de' => 'eintausend'],
  ];
  ?>
  @include('tpl.german-vocabulary')

  <h3>Года</h3>
  <p>Читаются сотнями. Например, 1998 год: девятнадцать сотен, восемь и девяносто — neunzehnhundertachtundneunzig.</p>
  <p>В речи:</p>
  <p>
    <span class="tooltipped tooltipped-s" aria-label="Когда есть вы рожденный?">— Wann sind Sie geboren?</span>
  </p>
  <p>Два варианта ответа:</p>
  <div>— Ich bin 1980 geboren.</div>
  <p>— Ich bin im Jahre 1980 geboren.</p>

  {{--<p>Другие примеры:</p>--}}
  {{--<div class="mt-3">— Wo sind Sie geboren?</div>--}}
  {{--<div>— Ich bin in Sankt-Petersburg geboren.</div>--}}
@endlang
@endsection
