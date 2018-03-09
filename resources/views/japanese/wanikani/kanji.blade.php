@extends('japanese.base', [
  'meta_title_replace' => ['kanji' => $kanji->character]
])

@section('content')
<h1 class="d-flex flex-wrap align-items-center">
  <a class="bg-secondary ja-shadow-light mr-2 px-3 py-1 rounded text-white"
     href="{{ path('JapaneseWanikaniLevel@show', $kanji->level) }}">{{ $kanji->level }}</a>
  <div class="bg-kanji ja-shadow-light text-white mr-3 px-2 py-1 rounded">{{ $kanji->character }}</div>
  <div class="text-capitalize">{{ $kanji->meaning }}</div>
</h1>

@if (sizeof($kanji->radicals))
  @ru
    <div class="mb-1">Иероглиф состоит из следующих ключей:</div>
  @endru
  <div class="d-flex flex-wrap align-items-center">
    @foreach ($kanji->radicals as $radical)
      <div class="font-weight-bold text-center text-white">
        <div class="bg-radical pt-1 pb-2 px-4 mb-1 mr-1 rounded">
          <a class="text-white" href="{{ path('JapaneseWanikaniRadicals@show', $radical->meaning) }}">
            @if ($radical->character)
              <div class="ja-big ja-character ja-shadow pb-2">{{ $radical->character }}</div>
            @else
              <div class="py-2">
                <img class="ja-character ja-image-shadow" src="{{ $radical->image }}" alt="" height="64">
              </div>
            @endif
            <div class="font-weight-bold ja-shadow-light radical-meaning text-capitalize">{{ $radical->meaning }}</div>
          </a>
        </div>
      </div>
    @endforeach
  </div>
@endif

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

<vocabulary action="{{ path('JapaneseWanikaniVocabulary@index') }}" :burned="true" :flat="true" kanji="{{ $kanji->character }}"></vocabulary>

<div class="mt-5">
  <a class="mr-3" href="{{ $kanji->externalLink() }}">
    WaniKani
    @svg (external-link)
  </a>

  <a class="mr-3" href="https://www.japandict.com/kanji/{{ $kanji->character }}">
    JapanDict
    @svg (external-link)
  </a>

  <a href="https://jisho.org/search/{{ $kanji->character }}%20%23kanji">
    Jisho
    @svg (external-link)
  </a>
</div>

@auth
<burn-kanji action="{{ path('JapaneseWanikaniKanji@destroy', $kanji->id) }}" :burned="{{ (int) !is_null($kanji->burnable) }}" inline-template>
  <div class="mt-4">
    <button class="btn btn-default" @click="toggleBurned">@{{ toggleBurnText }}</button>
  </div>
</burn-kanji>
@endauth
@endsection
