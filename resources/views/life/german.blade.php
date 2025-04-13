@extends('life.base', [
  'noLanguageSelector' => $locale === 'ru',
])

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">@lang('Немецкий')</h1>
@ru
  <p class="mb-12">Конспект информации, освоенной во время изучения языка.</p>
@endru

@ru
  <h3 class="font-medium text-2xl tracking-tight mb-2">Алфавит и произношение</h3>
  <div class="column-width-48">
    <div class="city-entry pb-2">A <span class="text-gray-500">[a:]</span></div>
    <div class="city-entry pb-2">B <span class="text-gray-500">[be:]</span></div>
    <div class="city-entry pb-2">C <span class="text-gray-500">[tse:]</span> ц, к, ч</div>
    <div class="city-entry pb-2">D <span class="text-gray-500">[de:]</span></div>
    <div class="city-entry pb-2">E <span class="text-gray-500">[e:]</span></div>
    <div class="city-entry pb-2">F <span class="text-gray-500">[ef]</span></div>
    <div class="city-entry pb-2">G <span class="text-gray-500">[ge:]</span></div>
    <div class="city-entry pb-2">H <span class="text-gray-500">[ha:]</span></div>
    <div class="city-entry pb-2">I <span class="text-gray-500">[i:]</span></div>
    <div class="city-entry pb-2">J <span class="text-gray-500">[jot:]</span> й</div>
    <div class="city-entry pb-2">K <span class="text-gray-500">[ka:]</span></div>
    <div class="city-entry pb-2">L <span class="text-gray-500">[el]</span> ль</div>
    <div class="city-entry pb-2">M <span class="text-gray-500">[em]</span></div>
    <div class="city-entry pb-2">N <span class="text-gray-500">[en]</span></div>
    <div class="city-entry pb-2">O <span class="text-gray-500">[o:]</span></div>
    <div class="city-entry pb-2">P <span class="text-gray-500">[pe:]</span></div>
    <div class="city-entry pb-2">Q <span class="text-gray-500">[ku:]</span></div>
    <div class="city-entry pb-2">R <span class="text-gray-500">[e:a]</span></div>
    <div class="city-entry pb-2">S <span class="text-gray-500">[es]</span> з,ш</div>
    <div class="city-entry pb-2">T <span class="text-gray-500">[te]</span></div>
    <div class="city-entry pb-2">U <span class="text-gray-500">[u:]</span></div>
    <div class="city-entry pb-2">V <span class="text-gray-500">[fau]</span> ф</div>
    <div class="city-entry pb-2">W <span class="text-gray-500">[ve:]</span></div>
    <div class="city-entry pb-2">X <span class="text-gray-500">[iks]</span> кс</div>
    <div class="city-entry pb-2">Y <span class="text-gray-500">['ypsilon]</span> й</div>
    <div class="city-entry pb-2">Z <span class="text-gray-500">[tset]</span> ц</div>
    <div class="city-entry pb-2">Ä <span class="text-gray-500">[e:]</span> ё</div>
    <div class="city-entry pb-2">Ö <span class="text-gray-500">[ø:]</span> ё</div>
    <div class="city-entry pb-2">Ü <span class="text-gray-500">[y:]</span> ю</div>
    <div class="city-entry pb-2">ß <span class="text-gray-500">[es'tset]</span> с</div>
  </div>

  <h3 class="font-medium text-2xl tracking-tight mt-6 mb-2">Дифтонги</h3>
  <div class="column-width-48">
    <div class="city-entry pb-2">ai, ei <span class="text-gray-500">[ай]</span></div>
    <div class="city-entry pb-2">ie <span class="text-gray-500">[и:]</span></div>
    <div class="city-entry pb-2">ig <span class="text-gray-500">[ихь]</span></div>
    <div class="city-entry pb-2">eu, äu <span class="text-gray-500">[ой]</span></div>
    <div class="city-entry pb-2">au <span class="text-gray-500">[ао]</span></div>
    <div class="city-entry pb-2">sch <span class="text-gray-500">[ш]</span></div>
    <div class="city-entry pb-2">tsch <span class="text-gray-500">[ч]</span></div>
    <div class="city-entry pb-2">st <span class="text-gray-500">[шт]</span></div>
    <div class="city-entry pb-2">sp <span class="text-gray-500">[шп]</span></div>
    <div class="city-entry pb-2">ph <span class="text-gray-500">[ф]</span></div>
    <div class="city-entry pb-2">rh <span class="text-gray-500">[р]</span></div>
    <div class="city-entry pb-2">th, dt <span class="text-gray-500">[т]</span></div>
    <div class="city-entry pb-2">tz, ts <span class="text-gray-500">[ц]</span></div>
    <div class="city-entry pb-2">ng <span class="text-gray-500">[η]</span></div>
    <div class="city-entry pb-2">nk <span class="text-gray-500">[ηк]</span></div>
    <div class="city-entry pb-2">ck <span class="text-gray-500">[к]</span></div>
    <div class="city-entry pb-2">qu <span class="text-gray-500">[кв]</span></div>
    <div class="city-entry pb-2">ch <span class="text-gray-500">[х]</span> Buch</div>
    <div class="city-entry pb-2">ch <span class="text-gray-500">[хь]</span> ich</div>
    <div class="city-entry pb-2">ch <span class="text-gray-500">[к]</span> sechs</div>
    <div class="city-entry pb-2">ch <span class="text-gray-500">[ш]</span> Chef</div>
    <div class="city-entry pb-2">ch <span class="text-gray-500">[ч]</span> checken</div>
  </div>

  <h3 class="font-medium text-2xl tracking-tight mt-6 mb-2">Спряжение глаголов</h3>
  <table class="table-stats">
    <thead>
    <tr>
      <td rowspan="2"></td>
      <td class="text-center" colspan="2">a</td>
      <td class="text-center" colspan="2">b</td>
    </tr>
    <tr>
      <td>heißen</td>
      <td>tanzen</td>
      <td>arbeiten</td>
      <td>baden</td>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>ich (я)</td>
      <td>heiße</td>
      <td>tanze</td>
      <td>arbeite</td>
      <td>bade</td>
    </tr>
    </tbody>
  </table>

  <ol class="mt-4" type="a">
    <li>Глаголы, основа которых оканчивается на -s, -z, -ß, во 2-м лице ед. ч. (du) не получают дополнительного -s- в окончании, так что формы второго и третьего лица совпадают.</li>
    <li>Глаголы, основа которых оканчивается на -t, -d во 2-м и 3-м лице ед.ч. (du; er/sie/es), а также во 2-м лице мн. числа (ihr) для удобства произнесения получают дополнительную -e- перед окончанием.</li>
  </ol>

  <h3 class="font-medium text-2xl tracking-tight mt-6 mb-2">Вопросительные слова</h3>
  <ul>
    <li>wer — кто?</li>
    <li>was — что?</li>
    <li>wie — как, каков?</li>
    <li>wann — когда?</li>
    <li>wo — где?</li>
    <li>wohin — куда?</li>
    <li>woher — откуда?</li>
  </ul>

  <h3 class="font-medium text-2xl tracking-tight mt-6 mb-2">Числа</h3>
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
    ['ru' => 16, 'de' => '<strong>sechzehn</strong>'],
    ['ru' => 17, 'de' => '<strong>siebzehn</strong>'],
    ['ru' => 18, 'de' => 'achtzehn'],
    ['ru' => 19, 'de' => 'neunzehn'],
    ['ru' => 20, 'de' => '<strong>zwanzig</strong>'],
    ['ru' => 30, 'de' => 'dreißig'],
    ['ru' => 40, 'de' => 'vierzig'],
    ['ru' => 47, 'de' => 'sieben&middot;und&middot;vierzig'],
    ['ru' => 50, 'de' => 'fünfzig'],
    ['ru' => 60, 'de' => 'sechzig'],
    ['ru' => 69, 'de' => 'neun&middot;und&middot;sechzig'],
    ['ru' => 70, 'de' => 'siebzig'],
    ['ru' => 80, 'de' => 'achtzig'],
    ['ru' => 90, 'de' => 'neunzig'],
    ['ru' => 100, 'de' => '(ein) hundert'],
    ['ru' => 200, 'de' => 'zweihundert'],
    ['ru' => 300, 'de' => 'dreihundert'],
    ['ru' => 743, 'de' => 'siebenhundertdreiundvierzig'],
    ['ru' => 1000, 'de' => '(ein) tausend'],
  ];
  ?>
  @include('tpl.german-vocabulary')

  <h3 class="font-medium text-2xl tracking-tight mt-12 mb-2">Дни недели</h3>
  <?php
  $entries = [
    ['ru' => 'понедельник', 'de' => 'Montag'],
    ['ru' => 'вторник', 'de' => 'Dienstag'],
    ['ru' => 'среда', 'de' => 'Mittwoch'],
    ['ru' => 'четверг', 'de' => 'Donnerstag'],
    ['ru' => 'пятница', 'de' => 'Freitag'],
    ['ru' => 'суббота', 'de' => 'Samstag'],
    ['ru' => 'воскресенье', 'de' => 'Sonntag'],
  ];
  ?>
  @include('tpl.german-vocabulary')

  <p class="mt-4">Дни недели обычно употребляются с предлогом <strong>am</strong>.</p>

  <p>Когда речь идет о повторяющихся в один день недели действиях, то используется множественное число без предлога.</p>

  <p>Промежуток времени можно выразить с помощью предлогов <strong>von</strong> и <strong>bis</strong> и дней недели без артикля.</p>

  <h3 class="font-medium text-2xl tracking-tight mt-12 mb-2">Года</h3>
  <p>Читаются сотнями. Например, 1998 год: девятнадцать сотен, восемь и девяносто — neunzehn&middot;hundert&middot;acht&middot;und&middot;neunzig.</p>
  <div>В речи:</div>
  <p>
    <span class="tooltipped tooltipped-n" aria-label="Когда есть вы рожденный?">— Wann sind Sie geboren?</span>
  </p>
  <div>Два варианта ответа:</div>
  <div>— Ich bin 1980 geboren.</div>
  <p>— Ich bin im Jahre 1980 geboren.</p>

  {{--<p>Другие примеры:</p>--}}
  {{--<div class="mt-4">— Wo sind Sie geboren?</div>--}}
  {{--<div>— Ich bin in Sankt-Petersburg geboren.</div>--}}
@endru
@endsection
