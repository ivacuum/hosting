<?php
/**
 * @var \App\Radical $radical
 * @var \App\Kanji $kanji
 * @var \App\Vocabulary $vocab
 */
?>

<div>
  <div class="items-center md:flex justify-between mb-4 md:mb-0 -mt-2">
    @if ($count > 0)
      <div class="flex flex-wrap">
        <h3 class="mb-2 md:mb-0 mr-4 pt-1">@lang('japanese.results', ['results' => $count])</h3>
        <button class="btn btn-default mb-2 md:mb-0" wire:click="clear">@lang('japanese.clear')</button>
      </div>
    @elseif ($q && $errors->isEmpty())
      <div class="bg-yellow-300 px-2 py-1 rounded">@lang('japanese.no-matches')</div>
    @endif
    <div class="hidden md:block">&nbsp;</div>
    <form class="max-w-500px" wire:submit.prevent="search">
      <div class="flex w-full">
        <input
          class="form-input rounded-r-none js-search-input"
          enterkeyhint="search"
          placeholder="@lang('Поиск...')"
          autocapitalize="none"
          wire:model.lazy="q"
        >
        <button class="btn btn-default -ml-px rounded-l-none">
          @svg (search)
        </button>
      </div>
    </form>
  </div>
  @error('q')
    <div class="md:text-right text-sm text-red-600">
      {{ $message }}
    </div>
  @enderror
  @if ($count > 0)
    <div class="my-4">
      @foreach ($radicals as $radical)
        <a
          class="flex items-center bg-radical border-radical justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $radical->www() }}"
        >
          @if ($radical->image)
            <div class="flex-shrink-0">
              <div class="text-4xl leading-none ja-image-shadow ja-svg">@svg (wk/$radical->meaning)</div>
            </div>
          @else
            <div class="text-4xl flex-shrink-0 leading-none ja-shadow pb-1 whitespace-no-wrap">{{ $radical->character }}</div>
          @endif
          <div class="flex-grow ja-shadow-light text-xs capitalize text-right">{{ $radical->meaning }}</div>
        </a>
      @endforeach
      @foreach ($kanjis as $kanji)
        <a
          class="flex items-center bg-kanji border-kanji justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $kanji->www() }}"
        >
          <div class="text-4xl flex-shrink-0 leading-none ja-shadow pb-1 whitespace-no-wrap">{{ $kanji->character }}</div>
          <div class="flex-grow text-right">
            <div class="font-bold ja-shadow-light">{{ $kanji->importantReading() }}</div>
            <div class="ja-shadow-light text-xs capitalize">{{ $kanji->meaning }}</div>
          </div>
        </a>
      @endforeach
      @foreach ($vocabularies as $vocab)
        <a
          class="flex items-center bg-vocab border-vocab justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $vocab->www() }}"
        >
          <div class="text-4xl flex-shrink-0 leading-none ja-shadow pb-1 whitespace-no-wrap">{{ $vocab->character }}</div>
          <div class="flex-grow text-right">
            <div class="font-bold ja-shadow-light">{{ $vocab->kana }}</div>
            <div class="ja-shadow-light text-xs capitalize">{{ $vocab->meaning }}</div>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</div>
