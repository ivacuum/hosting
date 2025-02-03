<?php /** @var \App\Livewire\WanikaniSearch $this */ ?>

<div>
  <div class="items-center md:flex justify-between mb-4 md:mb-0 -mt-2">
    @if ($this->count > 0)
      <div class="flex flex-wrap gap-4">
        <h3 class="font-medium text-2xl mb-2 md:mb-0 pt-1">@lang('japanese.results', ['results' => $this->count])</h3>
        <button class="btn btn-default mb-2 md:mb-0" wire:click="clear">@lang('Очистить')</button>
      </div>
    @elseif ($this->q && $errors->isEmpty())
      <div class="bg-yellow-300 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100 px-2 py-1 rounded-sm">@lang('japanese.no-matches')</div>
    @endif
    <div class="hidden md:block">&nbsp;</div>
    <form class="max-w-[500px]" wire:submit="search">
      <div class="flex w-full">
        <input
          class="the-input rounded-r-none js-search-input"
          type="search"
          enterkeyhint="search"
          placeholder="@lang('Поиск...')"
          autocapitalize="none"
          wire:model="q"
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
  @if ($this->count > 0)
    <div class="my-4">
      @foreach ($this->radicals as $radical)
        <a
          class="flex items-center bg-radical border-radical justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $radical->www() }}"
        >
          @if ($radical->image)
            <div class="shrink-0">
              <div class="text-4xl leading-none ja-image-shadow ja-svg">@svg (wk/$radical->meaning)</div>
            </div>
          @else
            <div class="text-4xl shrink-0 leading-none ja-shadow pb-1 whitespace-nowrap">{{ $radical->character }}</div>
          @endif
          <div class="grow ja-shadow-light text-xs capitalize text-right">{{ $radical->meaning }}</div>
        </a>
      @endforeach
      @foreach ($this->kanjis as $kanji)
        <a
          class="flex items-center bg-kanji border-kanji justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $kanji->www() }}"
        >
          <div class="text-4xl shrink-0 leading-none ja-shadow pb-1 whitespace-nowrap">{{ $kanji->character }}</div>
          <div class="grow text-right">
            <div class="font-bold ja-shadow-light">{{ $kanji->importantReading() }}</div>
            <div class="ja-shadow-light text-xs capitalize">{{ $kanji->meaning }}</div>
          </div>
        </a>
      @endforeach
      @foreach ($this->vocabularies as $vocab)
        <a
          class="flex items-center bg-vocab border-vocab justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
          href="{{ $vocab->www() }}"
        >
          <div class="text-4xl shrink-0 leading-none ja-shadow pb-1 whitespace-nowrap">{{ $vocab->character }}</div>
          <div class="grow text-right">
            <div class="font-bold ja-shadow-light">{{ $vocab->kana }}</div>
            <div class="ja-shadow-light text-xs capitalize">{{ $vocab->meaning }}</div>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</div>
