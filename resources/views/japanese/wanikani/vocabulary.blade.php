@extends('japanese.base', [
  'meta_replace' => ['vocab' => $vocabulary->character]
])

@section('content')
<h1 class="d-flex flex-wrap align-items-center">
  <a class="bg-secondary ja-shadow-light mr-2 px-3 py-1 rounded text-white"
     href="{{ path('JapaneseWanikaniLevel@show', $vocabulary->level) }}"
  >{{ $vocabulary->level }}</a>
  <div class="bg-vocab ja-shadow-light mr-3 px-2 py-1 rounded text-white">{{ $vocabulary->character }}</div>
  <div class="f24 text-capitalize">{{ $vocabulary->meaning }}</div>
</h1>

<div>
  <span class="text-muted">{{ trans('japanese.reading') }}</span>
  <span class="f20">【{{ $vocabulary->kana }}】</span>
</div>

<kanji
  action="{{ path('JapaneseWanikaniKanji@index') }}"
  :burned="true"
  :flat="true"
  :vocabulary-id="{{ $vocabulary->id }}"
></kanji>

@if ($vocabulary->sentences)
<h3 class="mt-5">Примеры предложений</h3>
<div class="f20" style="white-space: pre-line;">{{ $vocabulary->sentences }}</div>
@endif

<div class="mt-4">
  <a class="mr-3" href="{{ $vocabulary->externalLink() }}">
    WaniKani
    @svg (external-link)
  </a>

  <a class="mr-3" href="https://www.japandict.com/{{ $vocabulary->character }}">
    JapanDict
    @svg (external-link)
  </a>

  <a href="https://jisho.org/search/{{ $vocabulary->character }}">
    Jisho
    @svg (external-link)
  </a>
</div>

@auth
<div class="mt-4">
  <burn-vocabulary
    action="{{ path('JapaneseWanikaniVocabulary@destroy', $vocabulary->id) }}"
    :burned="{{ (int) !is_null($vocabulary->burnable) }}"
  ></burn-vocabulary>
</div>
@endauth
@endsection
