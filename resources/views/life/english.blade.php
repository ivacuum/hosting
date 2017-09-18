<?php \Breadcrumbs::push(trans('life.english')); ?>

@extends('life.base', [
  'meta_title' => trans('life.english'),
])

@section('content')
<h1 class="mt-0">{{ trans('life.english') }}</h1>
@ru
  <p class="mb-5">Конспект информации, освоенной во время изучения языка.</p>
@endru

<a name="irregular-verbs"></a>
<h2>@ru Неправильные глаголы @en Irregular Verbs @endru</h2>
<table class="table-stats mb-5">
  <thead>
  <tr>
    <th>Infinitive</th>
    <th>Past Simple</th>
    <th>Past Participle</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>be</td>
    <td>was</td>
    <td>been</td>
  </tr>
  <tr>
    <td>burn</td>
    <td>burnt</td>
    <td>burnt</td>
  </tr>
  <tr>
    <td>cut</td>
    <td>cut</td>
    <td>cut</td>
  </tr>
  <tr>
    <td>hurt</td>
    <td>hurt</td>
    <td>hurt</td>
  </tr>
  <tr>
    <td>wake</td>
    <td>woke</td>
    <td>woken</td>
  </tr>
  <tr>
    <td>wear</td>
    <td>wore</td>
    <td>worn</td>
  </tr>
  <tr>
    <td>win</td>
    <td>won</td>
    <td>won</td>
  </tr>
  <tr>
    <td>write</td>
    <td>wrote</td>
    <td>written</td>
  </tr>
  </tbody>
</table>

<a name="articles"></a>
<h2>@ru Артикли @en Articles @endru</h2>
<blockquote>
  <div>— Johnny, do you know where <b>the</b> Pyramids are?</div>
  <div>— No, miss, they must be lost. There was <b>a</b> teacher here yesterday asking <b>the</b> same question.</div>
</blockquote>

<ol class="mt-5">
  <li class="mb-3">
    <b>A/An</b> is used with <b>singular countable</b> nouns when we talk about things <b>in general</b>.
    <blockquote class="text-muted">
      <div><b>An</b> aeroplane is faster than <b>a</b> train.</div>
      <div>(Which aeroplane? Aeroplanes in general.)</div>
      <div class="mt-3"><b>A</b> greengrocer sells vegetables.</div>
      <div>(Which greengrocer? Greengrocers in general.)</div>
    </blockquote>
  </li>
  <li class="mb-3">
    We often use <b>a/an</b> after the verbs <b>to be</b> and <b>to have</b>.
    <blockquote class="text-muted">
      <div>He <b>is</b> a photographer. He <b>has got</b> a camera.</div>
    </blockquote>
  </li>
  <li class="mb-3">
    We do not use <b>a/an</b> with <b>uncountable</b> or <b>plural</b> nouns. We can use <b>some</b> instead.
    <blockquote class="text-muted">
      <div>Would you like <b>some</b> tea? Yes, please! And I'd like <b>some</b> biscuits.</div>
    </blockquote>
  </li>
  <li class="mb-3">
    <b>The</b> is used before <b>singular</b> and <b>plural</b> nouns, both <b>countable</b> and <b>uncountable</b> when we are talking about something <b>specific</b> or when the noun is mentioned <b>for a second time</b>.
    <blockquote class="text-muted">
      <div><b>The</b> boy who has just left is my cousin. (Which boy? Not any boy. The specific boy, the boy who has just left.)</div>
      <div class="mt-3">There is a cat on the sofa. <b>The</b> cat is sleeping. ("The cat" is mentioned for a second time.)</div>
    </blockquote>
  </li>
  <li class="mb-3">
    We use <b>the</b> with the words <b>cinema, theatre, radio, country(side), seaside, beach, etc</b>.
    <blockquote class="text-muted">
      <div>We go to <b>the beach</b> every Sunday.</div>
    </blockquote>
  </li>
  <li>
    We use both <b>a/an</b> or <b>the</b> before a singular countable noun to represent a <b>class</b> of people, animals or things.
    <blockquote class="text-muted">
      <div><b>A/The</b> dolphin is more intelligent than <b>a/the</b> shark. (We mean dolphins and sharks in general.)</div>
      <div class="mt-3"><b>ALSO:</b> Dolphins are more intelligent than sharks.</div>
    </blockquote>
  </li>
</ol>

<div class="row mt-5">
  <div class="col-md-6">
    <p><b>The</b> is also used before:</p>
    <ol>
      <li class="mb-3">
        nouns which are unique.
        <blockquote class="text-muted">
          Haven't you been to <b>the Acropolis</b> yet?
        </blockquote>
      </li>
      <li class="mb-3">
        names of cinemas (the Odeon), hotels (the Hilton), theatres (the Rex), museums (the Prado), newspapers (the Times), ships (the Queen Mary).
      </li>
      <li class="mb-3">
        names of rivers (the Thames), seas (the Black Sea), groups of islands/states (the Bahamas, the USA), mountain ranges (the Alps), deserts (the Gobi desert), oceans (the Pacific) and names with ... of (The Tower of London).
      </li>
      <li class="mb-3">
        musical instruments.
        <blockquote class="text-muted">
          Can you play the guitar?
        </blockquote>
      </li>
      <li class="mb-3">
        names of people / families / nationalities in the plural.
        <blockquote class="text-muted">
          the Smiths, the English, the Dutch etc.
        </blockquote>
      </li>
      <li class="mb-3">
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
  <div class="col-md-6">
    <p><b>The</b> is omitted before:</p>
    <ol>
      <li class="mb-3">
        proper nouns.
        <blockquote class="text-muted">
          <b>Paula</b> comes from <b>Canada</b>.
        </blockquote>
      </li>
      <li class="mb-3">
        names of sports, activities, colours, substances and meals.
        <blockquote class="text-muted">
          <div>He plays <b>tennis</b> well.</div>
          <div>She likes <b>blue</b>.</div>
          <div><b>Coke</b> isn't expensive.</div>
          <div><b>Lunch</b> is ready.</div>
        </blockquote>
      </li>
      <li class="mb-3">
        names of countries (England), cities (London), streets (Bond Street), parks (Hyde Park), mountains (Everest), islands (Cyprus), lakes (Lake Michigan), continents (Europe).
      </li>
      <li class="mb-3">
        the possessive case or possessive adj.
        <blockquote class="text-muted">
          This isn't <b>your</b> coat, it's <b>Kate's</b>.
        </blockquote>
      </li>
      <li class="mb-3">
        the words "home" and "Father/Mother" when we talk about our own home/parents.
        <blockquote class="text-muted">
          <b>Father</b> isn't at <b>home</b>.
        </blockquote>
      </li>
      <li class="mb-3">
        titles with proper names.
        <blockquote class="text-muted">
          Queen Elizabeth, President Kennedy
        </blockquote>
      </li>
      <li class="mb-3">
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
