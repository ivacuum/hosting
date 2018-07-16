@extends('japanese.wanikani.base', [
  'meta_replace' => ['kanji' => $kanji->character]
])

@section('content')
<h1 class="d-flex flex-wrap align-items-center">
  <a class="bg-secondary ja-shadow-light mr-2 px-3 py-1 rounded text-white"
     href="{{ path('JapaneseWanikaniLevel@show', $kanji->level) }}">{{ $kanji->level }}</a>
  <div class="bg-kanji ja-shadow-light text-white mr-3 px-2 py-1 rounded">{{ $kanji->character }}</div>
  <div class="text-capitalize">{{ $kanji->meaning }}</div>
</h1>

<h3 class="mt-4">{{ trans('japanese.readings') }}</h3>
<div class="mb-4">
  @if ($kanji->onyomi)
    <span class="text-muted">On'yomi</span>
    <span class="f20 mr-3">【{{ $kanji->katakanaOnyomi() }}】</span>
  @endif
  @if ($kanji->kunyomi)
    <span class="text-muted">Kun'yomi</span>
    <span class="f20">【{{ $kanji->kunyomi }}】</span>
  @endif
</div>

<radicals
  action="{{ path('JapaneseWanikaniRadicals@index') }}"
  burned
  flat
  :kanji-id="{{ $kanji->id }}"
></radicals>

<kanji
  action="{{ path('JapaneseWanikaniKanji@index') }}"
  burned
  flat
  :similar-id="{{ $kanji->id }}"
></kanji>

<vocabulary
  action="{{ path('JapaneseWanikaniVocabulary@index') }}"
  burned
  flat
  kanji="{{ $kanji->character }}"
></vocabulary>

<div class="mt-5">
  <a class="mr-3" href="{{ $kanji->externalLink() }}" rel="noreferrer">
    WaniKani
    @svg (external-link)
  </a>

  <a class="mr-3" href="https://www.japandict.com/kanji/{{ $kanji->character }}" rel="noreferrer">
    JapanDict
    @svg (external-link)
  </a>

  <a href="https://jisho.org/search/{{ $kanji->character }}%20%23kanji" rel="noreferrer">
    Jisho
    @svg (external-link)
  </a>
</div>

@auth
<div class="mt-4">
  <burn-kanji
    action="{{ path('JapaneseWanikaniKanji@destroy', $kanji->id) }}"
    :burned="{{ intval(null !== $kanji->burnable) }}"
  ></burn-kanji>
</div>
@endauth
@endsection
