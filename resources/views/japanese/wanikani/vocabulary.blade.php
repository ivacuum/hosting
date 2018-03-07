@extends('japanese.base', [
  'meta_title_replace' => ['vocab' => $vocabulary->character]
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

@if (sizeof($kanjis))
  <div class="mt-4 mb-1">{{ trans('japanese.vocabulary-utilized-kanji') }}</div>
  <div class="d-flex flex-wrap">
    @foreach ($kanjis as $kanji)
      <div class="font-weight-bold text-center text-white">
        <div class="bg-kanji pt-1 pb-2 px-4 mb-1 mr-1 rounded">
          <a class="d-block ja-big ja-character ja-shadow pb-2 text-white"
             href="{{ path('JapaneseWanikaniKanji@show', $kanji->character) }}"
          >{{ $kanji->character }}</a>
          <div class="kanji-reading ja-shadow-light">{{ $kanji->importantReading() }}</div>
          <div class="kanji-meaning ja-shadow-light text-capitalize">{{ $kanji->firstMeaning() }}</div>
        </div>
      </div>
    @endforeach
  </div>
@endif

@if ($vocabulary->sentences)
<h3 class="mt-5">Примеры предложений</h3>
<div class="f20" style="white-space: pre-line;">{{ $vocabulary->sentences }}</div>
@endif

<div class="mt-4">
  <a href="{{ $vocabulary->externalLink() }}">
    WaniKani
    @svg (external-link)
  </a>
</div>

@auth
<burn-vocabulary action="{{ path('JapaneseWanikaniVocabulary@destroy', $vocabulary->id) }}" :burned="{{ (int) !is_null($vocabulary->burnable) }}" inline-template>
  <div class="mt-4">
    <button class="btn btn-default" @click="toggleBurned">@{{ toggleBurnText }}</button>
  </div>
</burn-vocabulary>
@endauth
@endsection
