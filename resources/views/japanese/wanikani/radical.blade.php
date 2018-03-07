@extends('japanese.base', [
  'meta_title_replace' => ['radical' => $radical->meaning]
])

@section('content')
<h1 class="d-flex flex-wrap align-items-center">
  <a class="bg-secondary ja-shadow-light mr-2 px-3 py-1 rounded text-white"
     href="{{ path('JapaneseWanikaniLevel@show', $radical->level) }}"
  >{{ $radical->level }}</a>
  <div class="bg-radical text-white mr-3 px-2 py-1 rounded">
    @if ($radical->character)
      <span class="ja-character ja-shadow-light">{{ $radical->character }}</span>
    @else
      <img class="d-block ja-character ja-image-shadow" src="{{ $radical->image }}" alt="" height="38">
    @endif
  </div>
  <div class="text-capitalize">{{ $radical->meaning }}</div>
</h1>

@if (sizeof($radical->kanjis))
  @ru
    <div class="mb-1">Иероглифы, в которых встречается данный ключ:</div>
  @endru
  <div class="d-flex flex-wrap">
    <div class="d-flex flex-wrap">
      @foreach ($radical->kanjis as $kanji)
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
  </div>
@endif

<div class="mt-4">
  <a href="{{ $radical->externalLink() }}">
    WaniKani
    @svg (external-link)
  </a>
</div>

@auth
<burn-radical action="{{ path('JapaneseWanikaniRadicals@destroy', $radical->id) }}" :burned="{{ (int) !is_null($radical->burnable) }}" inline-template>
  <div class="mt-4">
    <button class="btn btn-default" @click="toggleBurned">@{{ toggleBurnText }}</button>
  </div>
</burn-radical>
@endauth
@endsection
