<?php /** @var \App\Livewire\VocabularyList $this */ ?>

<div>
  <div class="sm:flex items-center justify-between mt-6 mb-1">
    <h3 class="font-medium text-2xl mb-2">
      <span>{{ $this->range ? __('Уровень :level', ['level' => $this->level]) : __('japanese.vocabulary') }}</span>
      <span class="text-base text-gray-500">{{ $this->vocabularies->count() }}</span>
    </h3>
    <div>
      <button
        class="btn btn-default leading-none"
        wire:click="$toggle('showLabels')"
      >{{ $this->showLabels ? __('japanese.hide-labels') : __('japanese.show-labels') }}</button>
      @if (!$this->flat)
        <button
          class="btn btn-default leading-none"
          wire:click="shuffle"
        >@lang('japanese.shuffle')</button>
        @auth
          <button
            class="btn btn-default leading-none"
            wire:click="$toggle('showBurned')"
          >{{ $this->showBurned ? __('japanese.hide-burned') : __('japanese.show-burned') }}</button>
        @endauth
      @endif
    </div>
  </div>
  <div class="grid items-center text-xl text-center md:text-left vocab-grid gap-x-2 gap-y-1">
    @foreach ($this->vocabularies as $vocab)
      @if(auth()->id() && !$this->showBurned && isset($this->burned[$vocab->id]))
        <div hidden></div>
        <div hidden></div>
        <div hidden></div>
        <div hidden></div>
        <div hidden></div>
      @else
        <div>
          <a
            class="inline-block text-4xl leading-tight ja-shadow-light px-2 rounded-sm whitespace-nowrap text-white hover:text-grey-200 {{ auth()->id() && isset($this->burned[$vocab->id]) ? 'bg-burned' : 'bg-vocab' }}"
            href="{{ $vocab->www() }}"
          >{{ $vocab->character }}</a>
        </div>
        <a
          class="text-center py-1 {{ $this->showLabels ? 'invisible' : '' }}"
          href="#"
          wire:click.prevent="reveal({{ $vocab->id }})"
        >？</a>
        <div class="text-gray-500">
          @foreach (explode(', ', $vocab->kana) as $kana)
            <div class="leading-none whitespace-nowrap {{ $this->showLabels || @$this->visible[$vocab->id] ? '' : 'invisible hidden md:block' }}">
              【{{ $kana }}】
            </div>
          @endforeach
        </div>
        <div class="{{ $this->showLabels || @$this->visible[$vocab->id] ? '' : 'invisible hidden md:block' }}">
          {{ $vocab->meaning }}
        </div>
        @auth
          <a
            class="mb-6 md:mb-0 md:px-2 md:py-1 md:text-right {{ $this->showLabels || @$this->visible[$vocab->id] ? '' : 'invisible hidden md:block' }}"
            href="#"
            wire:click.prevent="burn({{ $vocab->id }})"
          >
            <span class="{{ auth()->id() && isset($this->burned[$vocab->id]) ? 'text-gray-600 hover:text-gray-800' : 'text-red-600 hover:text-red-800' }}">
              @svg (flame)
            </span>
          </a>
        @else
          <span></span>
        @endauth
      @endif
    @endforeach
  </div>
</div>
