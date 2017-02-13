<?php \Breadcrumbs::push(trans('life.english')); ?>

@extends('life.base', [
  'meta_title' => trans('life.english'),
])

@section('content')
<h1 class="mt-0">{{ trans('life.english') }}</h1>
@ru
  <p class="mb-5">Конспект информации, освоенной во время изучения языка.</p>
@endlang

<h2>17. Articles</h2>
<div>— Johnny, do you know where <b>the</b> Pyramids are?</div>
<div>— No, miss, they must be lost. There was <b>a</b> teacher here yesterday asking <b>the</b> same question.</div>

<ol class="mt-5">
  <li class="mb-3">
    <b>A/An</b> is used with <b>singular countable</b> nouns when we talk about things <b>in general</b>.
    <div class="text-muted">
      <div><b>An</b> aeroplane is faster than <b>a</b> train.</div>
      <div>(Which aeroplane? Aeroplanes in general.)</div>
      <div class="mt-3"><b>A</b> greengrocer sells vegetables.</div>
      <div>(Which greengrocer? Greengrocers in general.)</div>
    </div>
  </li>
  <li class="mb-3">
    We often use <b>a/an</b> after the verbs <b>to be</b> and <b>to have</b>.
  </li>
  <li class="mb-3">
    We do not use <b>a/an</b> with <b>uncountable</b> or <b>plural</b> nouns. We can use <b>some</b> instead.
  </li>
  <li class="mb-3">
    <b>The</b> is used before <b>singular</b> and <b>plural</b> nouns, both <b>countable</b> and <b>uncountable</b> when we are talking about something <b>specific</b> or when the noun is mentioned <b>for a second time</b>.
    <div class="text-muted">
      <div><b>The</b> boy who has just left is my cousin. (Which boy? Not any boy. The specific boy, the boy who has just left.)</div>
      <div class="mt-3">There is a cat on the sofa. <b>The</b> cat is sleeping. ("The cat" is mentioned for a second time.)</div>
    </div>
  </li>
  <li class="mb-3">
    We use <b>the</b> with the words <b>cinema, theatre, radio, country(side), seaside, beach, etc</b>.
    <div class="text-muted">
      <div>We go to <b>the beach</b> every Sunday.</div>
    </div>
  </li>
  <li>
    We use both <b>a/an</b> or <b>the</b> before a singular countable noun to represent a <b>class</b> of people, animals or things.
    <div class="text-muted">
      <div><b>A/The</b> dolphin is more intelligent than <b>a/the</b> shark. (We mean dolphins and sharks in general.)</div>
      <div class="mt-3"><b>ALSO:</b> Dolphins are more intelligent than sharks.</div>
    </div>
  </li>
</ol>
@endsection
