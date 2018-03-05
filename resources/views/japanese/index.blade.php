@extends('japanese.base')

@section('content')
<h1 class="h2">{{ trans('japanese.index') }}</h1>
@ru
  <p>Полезные ресурсы для самостоятельных студентов.</p>

  <h3 class="mt-4"><a class="link" href="{{ path('JapaneseHiraganaKatakana@index') }}">Тренажер хираганы и катаканы</a></h3>
  <p>Быстрое освоение японских слоговых азбук столбик за столбиком.</p>

  <h3 class="mt-4"><a class="link" href="{{ path('JapaneseWanikani@index') }}">{{ trans('japanese.wanikani') }}</a></h3>
  <p>Набор ключей, иероглифов и словарных слов для изучения и повторения. Данные и вдохновение взяты с сайта <a class="link" href="https://www.wanikani.com/">wanikani.com</a> и приправлены дополнительными функциями для улучшения процесса обучения.</p>
@en
  <p>Helpful resources for self-learning students.</p>

  <h3 class="mt-4"><a class="link" href="{{ path('JapaneseHiraganaKatakana@index') }}">Hiragana & Katakana trainer</a></h3>
  <p>Learn Japanese syllabaries column by column the fast way.</p>

  <h3 class="mt-4"><a class="link" href="{{ path('JapaneseWanikani@index') }}">{{ trans('japanese.wanikani') }}</a></h3>
  <p>Set of radicals, kanji and vocabulary to study and review. Data and inspiration from <a class="link" href="https://www.wanikani.com/">wanikani.com</a> with features added to make learning and review process more effective.</p>
@endru
@endsection
