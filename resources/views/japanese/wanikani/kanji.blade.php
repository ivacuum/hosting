<?php /** @var \App\Kanji $kanji */ ?>

@extends('japanese.wanikani.base')

@section('content')
<div class="items-center flex flex-wrap font-medium text-4xl">
  <a
    class="bg-gray-600 hover:bg-gray-700 ja-shadow-light mr-2 px-4 py-1 rounded-sm text-white hover:text-white"
    href="{{ to('japanese/wanikani/level/{level}', $kanji->level) }}"
  >{{ $kanji->level }}</a>
  <div class="bg-kanji ja-shadow-light text-white mr-4 px-2 py-1 rounded-sm">{{ $kanji->character }}</div>
  <div class="capitalize tracking-tight">{{ $kanji->meaning }}</div>
</div>

<h3 class="font-medium text-2xl mt-6 mb-2">@lang('Варианты чтения')</h3>
<div class="mb-6">
  @if ($kanji->onyomi)
    <span class="text-gray-500">On'yomi</span>
    <span class="text-xl mr-4">【{{ $kanji->onyomi }}】</span>
  @endif
  @if ($kanji->kunyomi)
    <span class="text-gray-500">Kun'yomi</span>
    <span class="text-xl">【{{ $kanji->kunyomi }}】</span>
  @endif
</div>

@livewire(App\Livewire\RadicalList::class, ['kanjiId' => $kanji->id])
@livewire(App\Livewire\KanjiList::class, ['similarId' => $kanji->id])
@livewire(App\Livewire\VocabularyList::class, ['kanji' => $kanji->character])

<div class="mt-12">
  <a class="mr-4" href="{{ $kanji->externalLink() }}" rel="noreferrer">
    WaniKani
    @svg (external-link)
  </a>

  <a class="mr-4" href="https://www.japandict.com/kanji/{{ $kanji->character }}" rel="noreferrer">
    JapanDict
    @svg (external-link)
  </a>

  <a href="https://jisho.org/search/{{ $kanji->character }}%20%23kanji" rel="noreferrer">
    Jisho
    @svg (external-link)
  </a>
</div>

@auth
  <div class="mt-6">
    @livewire(App\Livewire\BurnKanji::class, ['id' => $kanji->id, 'burned' => $kanji->burnable !== null])
  </div>
@endauth
@endsection
