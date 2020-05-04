<?php /** @var \App\Radical $radical */ ?>

@extends('japanese.wanikani.base')

@section('content')
<div class="items-center flex flex-wrap h1">
  <a
    class="bg-gray-600 hover:bg-gray-700 ja-shadow-light mr-2 px-4 py-1 rounded text-white hover:text-white"
    href="{{ path(App\Http\Controllers\WanikaniLevelController::class, $radical->level) }}"
  >{{ $radical->level }}</a>
  <div class="bg-radical text-white mr-4 px-2 py-1 rounded">
    @if ($radical->character)
      <span class="ja-shadow-light">{{ $radical->character }}</span>
    @else
      <div class="ja-image-shadow ja-svg">
        @svg (wk/$radical->meaning)
      </div>
    @endif
  </div>
  <div class="capitalize">{{ $radical->meaning }}</div>
</div>

@livewire(App\Http\Livewire\KanjiList::class, ['radicalId' => $radical->id])

<div class="mt-12">
  <a class="mr-4" href="{{ $radical->externalLink() }}" rel="noreferrer">
    WaniKani
    @svg (external-link)
  </a>
</div>

@auth
  <div class="mt-6">
    @livewire(App\Http\Livewire\BurnRadical::class, ['id' => $radical->id, 'burned' => $radical->burnable !== null])
  </div>
@endauth
@endsection
