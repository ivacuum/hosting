<?php \Breadcrumbs::push(trans('life.english')); ?>

@extends('life.base', [
  'meta_title' => trans('life.english'),
])

{{--
https://english.stackexchange.com/questions/51209/translate-into-vs-translate-to
--}}

@section('content')
<h1>{{ trans('life.english') }}</h1>
@ru
  <p class="tw-mb-12">Конспект информации, освоенной во время изучения языка.</p>
@endru

<a id="irregular-verbs"></a>
<h2>@ru Неправильные глаголы @en Irregular Verbs @endru</h2>
<?php
$irregular_verbs = [
  ['be', 'was', 'been'],
  ['bear', 'bore', 'born(e)'],
  ['beat', 'beat', 'beaten'],
  ['become', 'became', 'become'],
  ['begin', 'began', 'begun'],
  ['bite', 'bit', 'bitten'],
  ['blow', 'blew', 'blown'],
  ['break', 'broke', 'broken'],
  ['bring', 'brought', 'brought'],
  ['build', 'built', 'built'],
  ['burn', 'burnt', 'burnt'],
  ['burst', 'burst', 'burst'],
  ['buy', 'bought', 'bought'],
  ['can', 'could', '(been able to)'],
  ['catch', 'caught', 'caught'],
  ['choose', 'chose', 'chosen'],
  ['come', 'came', 'come'],
  ['cost', 'cost', 'cost'],
  ['cut', 'cut', 'cut'],
  ['deal', 'dealt', 'dealt'],
  ['dig', 'dug', 'dug'],
  ['do', 'did', 'done'],
  ['draw', 'drew', 'drawn'],
  ['dream', 'dreamt', 'dreamt'],
  ['drink', 'drank', 'drunk'],
  ['drive', 'drew', 'drawn'],
  ['eat', 'ate', 'eaten'],
  ['fall', 'fell', 'fallen'],
  ['feed', 'fed', 'fed'],
  ['feel', 'felt', 'felt'],
  ['fight', 'fought', 'fought'],
  ['find', 'found', 'found'],
  ['fly', 'flew', 'flown'],
  ['forbid', 'forbade', 'forbidden'],
  ['forget', 'forgot', 'forgotten'],
  ['freeze', 'froze', 'frozen'],
  ['get', 'got', 'got'],
  ['give', 'gave', 'given'],
  ['go', 'went', 'gone'],
  ['grow', 'grew', 'grown'],
  ['hang', 'hung', 'hung'],
  ['have', 'had', 'had'],
  ['hear', 'heard', 'heard'],
  ['hide', 'hid', 'hidden'],
  ['hit', 'hit', 'hit'],
  ['hold', 'held', 'held'],
  ['hurt', 'hurt', 'hurt'],
  ['keep', 'kept', 'kept'],
  ['know', 'knew', 'known'],
  ['lay', 'laid', 'laid'],
  ['lead', 'led', 'led'],
  ['learn', 'learnt', 'learnt'],
  ['leave', 'left', 'left'],
  ['lend', 'lent', 'lent'],
  ['let', 'let', 'let'],
  ['lie', 'lay', 'lain'],
  ['light', 'lit', 'lit'],
  ['lose', 'lost', 'lost'],
  ['make', 'made', 'made'],
  ['mean', 'meant', 'meant'],
  ['meet', 'met', 'met'],
  ['pay', 'paid', 'paid'],
  ['put', 'put', 'put'],
  ['read', 'read', 'read'],
  ['ride', 'rode', 'ridden'],
  ['ring', 'rang', 'rung'],
  ['rise', 'rose', 'risen'],
  ['run', 'ran', 'run'],
  ['say', 'said', 'said'],
  ['see', 'saw', 'seen'],
  ['seek', 'sought', 'sought'],
  ['sell', 'sold', 'sold'],
  ['send', 'sent', 'sent'],
  ['set', 'set', 'set'],
  ['sew', 'sewed', 'sewn'],
  ['shake', 'shook', 'shaken'],
  ['shine', 'shone', 'shone'],
  ['shoot', 'shot', 'shot'],
  ['show', 'showed', 'shown'],
  ['shut', 'shut', 'shut'],
  ['sing', 'sang', 'sung'],
  ['sit', 'sat', 'sat'],
  ['sleep', 'slept', 'slept'],
  ['smell', 'smelt', 'smelt'],
  ['speak', 'spoke', 'spoken'],
  ['spell', 'spelt', 'spelt'],
  ['spend', 'spent', 'spent'],
  ['spill', 'spilt', 'spilt'],
  ['split', 'split', 'split'],
  ['spoil', 'spoilt', 'spoilt'],
  ['spread', 'spread', 'spread'],
  ['spring', 'sprang', 'sprung'],
  ['stand', 'stood', 'stood'],
  ['steal', 'stole', 'stolen'],
  ['stick', 'stuck', 'stuck'],
  ['sting', 'stung', 'stung'],
  ['strike', 'struck', 'struck'],
  ['swear', 'swore', 'sworn'],
  ['sweep', 'swept', 'swept'],
  ['swim', 'swam', 'swum'],
  ['take', 'took', 'taken'],
  ['teach', 'taught', 'taught'],
  ['tear', 'tore', 'torn'],
  ['tell', 'told', 'told'],
  ['think', 'thought', 'thought'],
  ['throw', 'threw', 'thrown'],
  ['understand', 'understood', 'understood'],
  ['wake', 'woke', 'woken'],
  ['wear', 'wore', 'worn'],
  ['win', 'won', 'won'],
  ['write', 'wrote', 'written'],
];
?>
<table class="table-stats tw-mb-12">
  <thead>
  <tr>
    <th>Infinitive</th>
    <th>Past Simple</th>
    <th>Past Participle</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($irregular_verbs as [$infinitive, $past_simple, $past_participle])
    <tr>
      <td>{{ $infinitive }}</td>
      <td>{{ $past_simple }}</td>
      <td>{{ $past_participle }}</td>
    </tr>
  @endforeach
  </tbody>
</table>

<a id="articles"></a>
<h2>@ru Артикли @en Articles @endru</h2>
<blockquote>
  <div>— Johnny, do you know where <b>the</b> Pyramids are?</div>
  <div>— No, miss, they must be lost. There was <b>a</b> teacher here yesterday asking <b>the</b> same question.</div>
</blockquote>

<ol class="tw-mt-12">
  <li class="tw-mb-4">
    <b>A/An</b> is used with <b>singular countable</b> nouns when we talk about things <b>in general</b>.
    <blockquote class="text-muted">
      <div><b>An</b> aeroplane is faster than <b>a</b> train.</div>
      <div>(Which aeroplane? Aeroplanes in general.)</div>
      <div class="tw-mt-4"><b>A</b> greengrocer sells vegetables.</div>
      <div>(Which greengrocer? Greengrocers in general.)</div>
    </blockquote>
  </li>
  <li class="tw-mb-4">
    We often use <b>a/an</b> after the verbs <b>to be</b> and <b>to have</b>.
    <blockquote class="text-muted">
      <div>He <b>is</b> a photographer. He <b>has got</b> a camera.</div>
    </blockquote>
  </li>
  <li class="tw-mb-4">
    We do not use <b>a/an</b> with <b>uncountable</b> or <b>plural</b> nouns. We can use <b>some</b> instead.
    <blockquote class="text-muted">
      <div>Would you like <b>some</b> tea? Yes, please! And I'd like <b>some</b> biscuits.</div>
    </blockquote>
  </li>
  <li class="tw-mb-4">
    <b>The</b> is used before <b>singular</b> and <b>plural</b> nouns, both <b>countable</b> and <b>uncountable</b> when we are talking about something <b>specific</b> or when the noun is mentioned <b>for a second time</b>.
    <blockquote class="text-muted">
      <div><b>The</b> boy who has just left is my cousin. (Which boy? Not any boy. The specific boy, the boy who has just left.)</div>
      <div class="tw-mt-4">There is a cat on the sofa. <b>The</b> cat is sleeping. ("The cat" is mentioned for a second time.)</div>
    </blockquote>
  </li>
  <li class="tw-mb-4">
    We use <b>the</b> with the words <b>cinema, theatre, radio, country(side), seaside, beach, etc</b>.
    <blockquote class="text-muted">
      <div>We go to <b>the beach</b> every Sunday.</div>
    </blockquote>
  </li>
  <li>
    We use both <b>a/an</b> or <b>the</b> before a singular countable noun to represent a <b>class</b> of people, animals or things.
    <blockquote class="text-muted">
      <div><b>A/The</b> dolphin is more intelligent than <b>a/the</b> shark. (We mean dolphins and sharks in general.)</div>
      <div class="tw-mt-4"><b>ALSO:</b> Dolphins are more intelligent than sharks.</div>
    </blockquote>
  </li>
</ol>

<div class="md:tw-flex md:tw--mx-4 tw-mt-12">
  <div class="md:tw-w-1/2 md:tw-px-4">
    <p><b>The</b> is also used before:</p>
    <ol>
      <li class="tw-mb-4">
        nouns which are unique.
        <blockquote class="text-muted">
          Haven't you been to <b>the Acropolis</b> yet?
        </blockquote>
      </li>
      <li class="tw-mb-4">
        names of cinemas (the Odeon), hotels (the Hilton), theatres (the Rex), museums (the Prado), newspapers (the Times), ships (the Queen Mary).
      </li>
      <li class="tw-mb-4">
        names of rivers (the Thames), seas (the Black Sea), groups of islands/states (the Bahamas, the USA), mountain ranges (the Alps), deserts (the Gobi desert), oceans (the Pacific) and names with ... of (The Tower of London).
      </li>
      <li class="tw-mb-4">
        musical instruments.
        <blockquote class="text-muted">
          Can you play the guitar?
        </blockquote>
      </li>
      <li class="tw-mb-4">
        names of people / families / nationalities in the plural.
        <blockquote class="text-muted">
          the Smiths, the English, the Dutch etc.
        </blockquote>
      </li>
      <li class="tw-mb-4">
        titles without proper names.
        <blockquote class="text-muted">
          the Queen, the President
        </blockquote>
      </li>
      <li>
        adjectives used as plural nouns (the rich) and the superlative degree of adjectives / adverbs (the best).
        <blockquote class="text-muted">
          He's <b>the most intelligent</b> student of all.
        </blockquote>
      </li>
    </ol>
  </div>
  <div class="md:tw-w-1/2 md:tw-px-4">
    <p><b>The</b> is omitted before:</p>
    <ol>
      <li class="tw-mb-4">
        proper nouns.
        <blockquote class="text-muted">
          <b>Paula</b> comes from <b>Canada</b>.
        </blockquote>
      </li>
      <li class="tw-mb-4">
        names of sports, activities, colours, substances and meals.
        <blockquote class="text-muted">
          <div>He plays <b>tennis</b> well.</div>
          <div>She likes <b>blue</b>.</div>
          <div><b>Coke</b> isn't expensive.</div>
          <div><b>Lunch</b> is ready.</div>
        </blockquote>
      </li>
      <li class="tw-mb-4">
        names of countries (England), cities (London), streets (Bond Street), parks (Hyde Park), mountains (Everest), islands (Cyprus), lakes (Lake Michigan), continents (Europe).
      </li>
      <li class="tw-mb-4">
        the possessive case or possessive adj.
        <blockquote class="text-muted">
          This isn't <b>your</b> coat, it's <b>Kate's</b>.
        </blockquote>
      </li>
      <li class="tw-mb-4">
        the words "home" and "Father/Mother" when we talk about our own home/parents.
        <blockquote class="text-muted">
          <b>Father</b> isn't at <b>home</b>.
        </blockquote>
      </li>
      <li class="tw-mb-4">
        titles with proper names.
        <blockquote class="text-muted">
          Queen Elizabeth, President Kennedy
        </blockquote>
      </li>
      <li class="tw-mb-4">
        bed, school, church, hospital, prison, when they are used for the reason they exist.
        <blockquote class="text-muted">
          <div>John was sent to <b>prison</b>.</div>
          <div><b>BUT</b>: His mother went to <b>the prison</b> to visit him last week.</div>
        </blockquote>
      </li>
    </ol>
  </div>
</div>
@endsection
