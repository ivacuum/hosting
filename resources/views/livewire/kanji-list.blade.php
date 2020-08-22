<?php /** @var \App\Kanji $kanji */ ?>

<div>
  @if ($kanjis->count())
    <div class="sm:flex items-center justify-between mt-6 mb-1">
      <h3>
        @if ($range)
          <span>@lang('Уровень :level', ['level' => $level])</span>
        @else
          <span>{{ $similarId ? __('japanese.similar-kanji') : __('japanese.kanji') }}</span>
        @endif
        <span class="text-base text-muted">{{ $kanjis->count() }}</span>
      </h3>
      <div>
        <button
          class="btn btn-default leading-none"
          wire:click="$toggle('showLabels')"
        >{{ $showLabels ? __('japanese.hide-labels') : __('japanese.show-labels') }}</button>
        @if (!$flat)
          <button
            class="btn btn-default leading-none"
            wire:click="shuffle"
          >@lang('japanese.shuffle')</button>
          @auth
            <button
              class="btn btn-default leading-none"
              wire:click="$toggle('showBurned')"
            >{{ $showBurned ? __('japanese.hide-burned') : __('japanese.show-burned') }}</button>
          @endauth
        @endif
      </div>
    </div>
    <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8 gap-px text-center text-white">
      @foreach ($kanjis as $kanji)
        <div class="group rounded {{ auth()->id() && $kanji->burnable ? 'bg-burned' : 'bg-kanji' }}">
          <a
            class="block text-6xl leading-none ja-shadow py-2 text-white hover:text-grey-200"
            href="{{ $kanji->www() }}"
          >{{ $kanji->character }}</a>
          <div class="{{ $showLabels ? '' : 'invisible group-hover:visible' }}">
            <div class="ja-shadow-light">{{ $kanji->importantReading() }}</div>
            <div class="ja-shadow-light capitalize pb-2">{{ $kanji->firstMeaning() }}</div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
