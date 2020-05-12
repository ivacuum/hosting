<?php /** @var \App\Vocabulary $vocab */ ?>

<div class="grid lg:grid-cols-2 gap-4">
  <div>
    <div class="text-center">
      <div>
        <a
          class="bg-vocab inline-block text-5xl leading-tight ja-shadow-light px-2 rounded whitespace-no-wrap text-white hover:text-grey-200"
          href="{{ $vocab->www() }}"
        >{{ $vocab->character }}</a>
      </div>
      <div class="text-3xl text-gray-600 whitespace-no-wrap">
        【{{ $hiragana ? $vocab->firstKana() : $vocab->toKatakana() }}】
      </div>
      <div class="text-2xl">
        @if ($reveal)
          <span class="text-green-600">{{ $vocab->toRomaji() }}</span>
        @else
          <button
            class="text-gray-500 tooltipped tooltipped-s"
            type="button"
            aria-label="{{ trans('japanese.reveal-answer') }}"
            wire:click="check"
          >@svg (question)</button>
        @endif
      </div>
    </div>

    <form class="mt-2" wire:submit.prevent="check">
      <input
        tabindex="1"
        autocapitalize="none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        placeholder="{{ trans('japanese.answer') }}"
        enterkeyhint="enter"
        class="form-input text-center {{ $reveal ? 'animate-incorrect-answer' : '' }}"
        {{ $reveal ? 'wire:dirty.class.remove="animate-incorrect-answer"' : '' }}
        wire:model.lazy="answer"
      >
    </form>

    <div class="grid grid-cols-3 gap-2 mt-3">
      <button
        class="btn btn-default px-0 text-sm sm:text-base"
        type="button"
        wire:click="skip"
      >{{ trans('japanese.skip') }}</button>
      @if ($vocab->male_audio_id)
        <div>
          <button
            class="btn border border-blue-300 hover:border-blue-400 bg-blue-200 hover:bg-blue-300 w-full"
            type="button"
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
            class="btn border border-red-300 hover:border-red-400 bg-red-200 hover:bg-red-300 w-full"
            type="button"
            onclick="document.querySelector('#female_audio').play()"
          >
            @svg (volume-up-full)
          </button>
          <audio id="female_audio" src="{{ $vocab->femaleAudioMp3() }}"></audio>
        </div>
      @endif
    </div>

    <div class="grid grid-cols-3 gap-2 mt-4">
      @if ($answered > 0)
        <div>
          <div class="text-sm small-caps text-green-500">{{ trans('japanese.answered') }}</div>
          <div class="text-2xl">{{ $answered }}</div>
        </div>
      @endif
      @if ($skipped > 0)
        <div>
          <div class="text-sm small-caps text-gray-500">{{ trans('japanese.skipped') }}</div>
          <div class="text-2xl">{{ $skipped }}</div>
        </div>
      @endif
      @if ($revealed > 0)
        <div>
          <div class="text-sm small-caps text-yellow-500">{{ trans('japanese.answers_revealed') }}</div>
          <div class="text-2xl">{{ $revealed }}</div>
        </div>
      @endif
    </div>
  </div>
  <div>
    <div class="grid gap-1 items-start">
      @foreach ($history as $entry)
        <div class="inline-flex items-center">
          <a
            class="bg-vocab inline-block text-2xl leading-tight ja-shadow-light px-2 rounded whitespace-no-wrap text-white hover:text-grey-200 mr-2"
            href="{{ $entry['www'] }}"
          >{{ $entry['character'] }}</a>
          <span class="leading-tight">{{ $entry['meaning'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
  <div>
    <details class="border text-sm rounded overflow-hidden" {{ $openSettings ? 'open' : '' }}>
      <summary class="border-b bg-gray-100 text-gray-500 hover:text-gray-700 px-5 py-2" itemprop="name">{{ trans('japanese.settings') }}: <span class="lowercase">{{ $hiragana ? trans('japanese.hiragana') : trans('japanese.katakana') }}, {{ trans('japanese.levels') }} {{ $level * 10 - 9 }}–{{ $level * 10 }}</span></summary>
      <div class="px-5 py-3 text-sm">
        <div class="h5">{{ trans('japanese.syllabary') }}</div>
        <div class="text-gray-500 mb-2">{{ trans('japanese.settings.syllabary_help') }}</div>
        <div>
          <button
            class="btn btn-default disabled:opacity-50"
            type="button"
            wire:click="switchToHiragana"
            {{ $hiragana ? 'disabled' : '' }}
          >{{ trans('japanese.hiragana') }}</button>
          <button
            class="btn btn-default disabled:opacity-50"
            type="button"
            wire:click="switchToKatakana"
            {{ $hiragana ? '' : 'disabled' }}
          >{{ trans('japanese.katakana') }}</button>
        </div>

        <div class="h5 mt-6">{{ trans('japanese.levels') }} {{ $level * 10 - 9 }}–{{ $level * 10 }}</div>
        <div class="text-gray-500 mb-2">{{ trans('japanese.settings.levels_help') }}</div>
        <div class="flex">
          <button
            class="btn btn-default mr-1 disabled:opacity-50"
            type="button"
            wire:click="decreaseLevel"
            {{ $level < 2 ? 'disabled' : '' }}
          >{{ trans('japanese.decrease') }}</button>
          <button
            class="btn btn-default disabled:opacity-50"
            type="button"
            wire:click="increaseLevel"
            {{ $level > 5 ? 'disabled' : '' }}
          >{{ trans('japanese.increase') }}</button>
        </div>
      </div>
    </details>
  </div>
</div>
