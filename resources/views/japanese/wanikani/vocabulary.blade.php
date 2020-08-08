<?php /** @var \App\Vocabulary $vocab */ ?>

@extends('japanese.wanikani.base')

@section('content')
<div class="items-center flex flex-wrap h1">
  <a
    class="bg-gray-600 hover:bg-gray-700 ja-shadow-light mr-2 px-4 py-1 rounded text-white hover:text-white"
    href="{{ path(App\Http\Controllers\WanikaniLevel::class, $vocab->level) }}"
  >{{ $vocab->level }}</a>
  <div class="bg-vocab ja-shadow-light mr-4 px-2 py-1 rounded text-white">{{ $vocab->character }}</div>
  <div class="text-2xl capitalize">{{ $vocab->meaning }}</div>
</div>

<div class="items-center flex flex-wrap">
  <span class="text-muted">{{ trans('japanese.reading') }}</span>
  <span class="text-xl">【{{ $vocab->kana }}】</span>
  @if ($vocab->male_audio_id)
    <div class="mr-1">
      <button
        class="btn leading-none bg-blue-200 hover:bg-blue-300"
        onclick="document.querySelector('#male_audio').play()"
      >
        @svg (volume-up-full)
      </button>
      <audio id="male_audio" src="{{ $vocab->maleAudioMp3() }}"></audio>
    </div>
  @endif
  @if ($vocab->female_audio_id)
    <div>
      <button
        class="btn leading-none bg-red-200 hover:bg-red-300"
        onclick="document.querySelector('#female_audio').play()"
      >
        @svg (volume-up-full)
      </button>
      <audio id="female_audio" src="{{ $vocab->femaleAudioMp3() }}"></audio>
    </div>
  @endif
</div>

@livewire(App\Http\Livewire\KanjiList::class, ['vocabularyId' => $vocab->id])

@if ($vocab->sentences)
  <div class="mt-12">
    <h3 class="mt-0">{{ trans('japanese.sentences') }}</h3>
    <div class="text-xl whitespace-pre-line">{{ $vocab->sentences }}</div>
  </div>
@endif

<div class="mt-12">
  <a class="mr-4" href="{{ $vocab->externalLink() }}" rel="noreferrer">
    WaniKani
    @svg (external-link)
  </a>

  <a class="mr-4" href="https://www.japandict.com/{{ $vocab->character }}" rel="noreferrer">
    JapanDict
    @svg (external-link)
  </a>

  <a href="https://jisho.org/search/{{ $vocab->character }}" rel="noreferrer">
    Jisho
    @svg (external-link)
  </a>
</div>

@auth
  <div class="mt-6">
    @livewire(App\Http\Livewire\BurnVocabulary::class, ['id' => $vocab->id, 'burned' => $vocab->burnable !== null])
  </div>
@endauth
@endsection
