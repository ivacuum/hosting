<?php /** @var \App\Livewire\VocabularyTrainer $this */ ?>

<div class="grid lg:grid-cols-2 gap-4">
  <div>
    <div class="text-center">
      <div>
        <a
          class="bg-vocab inline-block text-5xl leading-tight ja-shadow-light px-2 rounded whitespace-nowrap text-white hover:text-grey-200"
          href="{{ $this->vocab->www() }}"
        >{{ $this->vocab->character }}</a>
      </div>
      <div class="text-3xl text-gray-600 dark:text-slate-400 whitespace-nowrap">
        【{{ $this->hiragana ? $this->vocab->firstKana() : $this->vocab->toKatakana() }}】
      </div>
      <div class="text-2xl">
        @if ($this->reveal)
          <span class="text-green-600">{{ $this->vocab->toRomaji() }}</span>
        @else
          <button
            class="text-gray-500 dark:text-slate-400 tooltipped tooltipped-s"
            type="button"
            aria-label="@lang('japanese.reveal-answer')"
            wire:click="check"
          >@svg (question)</button>
        @endif
      </div>
    </div>

    <div class="mt-2">
      <input
        type="text"
        tabindex="1"
        autocapitalize="none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        placeholder="@lang('Ваш ответ')"
        enterkeyhint="send"
        class="form-input text-center {{ $this->reveal ? 'animate-incorrect-answer focus:border-red-300 focus:ring-red-300' : '' }}"
        {{ $this->reveal ? 'wire:dirty.class.remove="animate-incorrect-answer"' : '' }}
        wire:model="answer"
        wire:keydown.enter="check"
      >
    </div>

    <div class="grid grid-cols-3 gap-2 mt-3">
      <button
        class="btn btn-default px-0 text-sm sm:text-base"
        type="button"
        wire:click="skip"
      >@lang($this->reveal ? 'Далее' : 'Пропустить')</button>
      @if ($this->vocab->male_audio)
        <div>
          <button
            class="btn text-blue-800 dark:text-blue-700 border border-blue-300 hover:border-blue-400 bg-blue-200 dark:bg-blue-300 hover:bg-blue-300 hover:dark:bg-blue-400 w-full"
            type="button"
            onclick="document.querySelector('#male_audio').play()"
          >
            @svg (volume-up-full)
          </button>
          <audio id="male_audio" src="{{ $this->vocab->male_audio->externalLink() }}"></audio>
        </div>
      @endif
      @if ($this->vocab->female_audio)
        <div>
          <button
            class="btn text-red-800 dark:text-red-700 border border-red-300 hover:border-red-400 bg-red-200 hover:bg-red-300 w-full"
            type="button"
            onclick="document.querySelector('#female_audio').play()"
          >
            @svg (volume-up-full)
          </button>
          <audio id="female_audio" src="{{ $this->vocab->female_audio->externalLink() }}"></audio>
        </div>
      @endif
    </div>

    <div class="grid grid-cols-3 gap-2 mt-4">
      @if ($this->answered > 0)
        <div>
          <div class="text-sm small-caps text-green-500">@lang('japanese.answered')</div>
          <div class="text-2xl">{{ $this->answered }}</div>
        </div>
      @endif
      @if ($this->skipped > 0)
        <div>
          <div class="text-sm small-caps text-gray-500">@lang('japanese.skipped')</div>
          <div class="text-2xl">{{ $this->skipped }}</div>
        </div>
      @endif
      @if ($this->revealed > 0)
        <div>
          <div class="text-sm small-caps text-yellow-500">@lang('Подсказано')</div>
          <div class="text-2xl">{{ $this->revealed }}</div>
        </div>
      @endif
    </div>
  </div>
  <div>
    <div class="grid gap-1 items-start">
      @foreach ($this->history as $entry)
        <div class="inline-flex items-center">
          <a
            class="bg-vocab inline-block text-2xl leading-tight ja-shadow-light px-2 rounded whitespace-nowrap text-white hover:text-grey-200 mr-2"
            href="{{ $entry['www'] }}"
          >{{ $entry['character'] }}</a>
          <span class="leading-tight">{{ $entry['meaning'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
  <div>
    <details class="border dark:border-slate-700 text-sm rounded overflow-hidden" {{ $this->openSettings ? 'open' : '' }}>
      <summary class="border-b dark:border-slate-700 bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-slate-400 hover:text-gray-700 hover:dark:text-slate-200 px-5 py-2" itemprop="name">@lang('Настройки'): <span class="lowercase">{{ $this->hiragana ? __('Хирагана') : __('Катакана') }}, @lang('Уровни') {{ $this->level * 10 - 9 }}–{{ $this->level * 10 }}</span></summary>
      <div class="px-5 py-3 text-sm">
        <div class="font-medium text-lg">@lang('Азбука')</div>
        <div class="text-gray-500 mb-2">@lang('japanese.settings.syllabary_help')</div>
        <div class="flex gap-4 items-center">
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model.live="hiragana" value="1">
            @lang('Хирагана')
          </label>
          <label class="flex gap-2 items-center">
            <input class="border-gray-300" type="radio" wire:model.live="hiragana" value="0">
            @lang('Катакана')
          </label>
        </div>

        <div class="font-medium text-lg mt-6">@lang('Уровни') {{ $this->level * 10 - 9 }}–{{ $this->level * 10 }}</div>
        <div class="text-gray-500 mb-2">@lang('japanese.settings.levels_help')</div>
        <div class="flex gap-1">
          <button
            class="btn btn-default disabled:opacity-50"
            type="button"
            wire:click="decreaseLevel"
            {{ $this->level < 2 ? 'disabled' : '' }}
          >@lang('Уменьшить')</button>
          <button
            class="btn btn-default disabled:opacity-50"
            type="button"
            wire:click="increaseLevel"
            {{ $this->level > 5 ? 'disabled' : '' }}
          >@lang('Увеличить')</button>
        </div>
      </div>
    </details>
  </div>
</div>
