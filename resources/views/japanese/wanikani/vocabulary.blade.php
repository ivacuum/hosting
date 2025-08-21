<?php /** @var \App\Domain\Wanikani\Models\Vocabulary $vocab */ ?>

@extends('japanese.wanikani.base')

@section('content')
<div class="items-center flex flex-wrap font-medium text-4xl">
  <a
    class="bg-gray-600 hover:bg-gray-700 ja-shadow-light mr-2 px-4 py-1 rounded-sm text-white hover:text-white"
    href="{{ to('japanese/wanikani/level/{level}', $vocab->level) }}"
  >{{ $vocab->level }}</a>
  <div class="bg-vocab ja-shadow-light mr-4 px-2 py-1 rounded-sm text-white">{{ $vocab->character }}</div>
  <div class="text-2xl capitalize tracking-tight">{{ $vocab->meaning }}</div>
</div>

<div class="items-center flex flex-wrap gap-2 mt-6">
  <span class="text-gray-500">@lang('Чтение')</span>
  @if($vocab->character !== $vocab->kana)
    <span class="text-xl">【{{ $vocab->kana }}】</span>
  @endif
  @if ($vocab->male_audio)
    <div>
      <button
        class="btn leading-none bg-sky-200 dark:bg-sky-600 dark:hover:bg-sky-500 hover:bg-sky-300 dark:text-sky-50"
        onclick="document.querySelector('#male_audio').play()"
      >
        @svg (volume-up-full)
      </button>
      <audio id="male_audio" src="{{ $vocab->male_audio->externalLink() }}"></audio>
    </div>
  @endif
  @if ($vocab->female_audio)
    <div>
      <button
        class="btn leading-none bg-red-200 dark:bg-red-500 dark:hover:bg-red-400 hover:bg-red-300 dark:text-red-50"
        onclick="document.querySelector('#female_audio').play()"
      >
        @svg (volume-up-full)
      </button>
      <audio id="female_audio" src="{{ $vocab->female_audio->externalLink() }}"></audio>
    </div>
  @endif
</div>

@livewire(App\Livewire\KanjiList::class, ['vocabularyWord' => $vocab->character])

@if ($vocab->sentences)
  <div class="mt-12">
    <h3 class="font-medium text-2xl mb-2">@lang('Примеры предложений')</h3>
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
    @livewire(App\Livewire\BurnVocabulary::class, ['id' => $vocab->id, 'burned' => $vocab->burnable !== null])
  </div>
@endauth
@endsection
