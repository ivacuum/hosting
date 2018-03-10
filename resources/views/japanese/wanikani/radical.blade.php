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

<kanji
  action="{{ path('JapaneseWanikaniKanji@index') }}"
  :burned="true"
  :flat="true"
  :radical-id="{{ $radical->id }}"
></kanji>

<div class="mt-4">
  <a href="{{ $radical->externalLink() }}">
    WaniKani
    @svg (external-link)
  </a>
</div>

@auth
<div class="mt-4">
  <burn-radical
    action="{{ path('JapaneseWanikaniRadicals@destroy', $radical->id) }}"
    :burned="{{ (int) !is_null($radical->burnable) }}"
  ></burn-radical>
</div>
@endauth
@endsection
