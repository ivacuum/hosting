<?php /** @var \App\Vocabulary $vocab */ ?>

<div>
  <div class="sm:flex items-center justify-between mt-6 mb-1">
    <h3>
      <span>{{ $range ? trans('japanese.level', ['level' => $level]) : trans('japanese.vocabulary') }}</span>
      <span class="text-base text-muted">{{ $vocabularies->count() }}</span>
    </h3>
    <div>
      <button
        class="btn btn-default leading-none"
        wire:click="$toggle('showLabels')"
      >{{ $showLabels ? trans('japanese.hide-labels') : trans('japanese.show-labels') }}</button>
      @if (!$flat)
        <button
          class="btn btn-default leading-none"
          wire:click="shuffle"
        >{{ trans('japanese.shuffle') }}</button>
        @auth
          <button
            class="btn btn-default leading-none"
            wire:click="$toggle('showBurned')"
          >{{ $showBurned ? trans('japanese.hide-burned') : trans('japanese.show-burned') }}</button>
        @endauth
      @endif
    </div>
  </div>
  <div class="grid items-center text-xl text-center md:text-left vocab-grid col-gap-2 row-gap-1">
    @foreach ($vocabularies as $vocab)
      <div>
        <a
          class="inline-block text-4xl leading-tight ja-shadow-light px-2 rounded whitespace-no-wrap text-white hover:text-grey-200 {{ $vocab->burnable === null ? 'bg-vocab' : 'bg-burned' }}"
          href="{{ $vocab->www() }}"
        >{{ $vocab->character }}</a>
      </div>
      <a
        class="text-center py-1 {{ $showLabels ? 'invisible' : '' }}"
        href="#"
        wire:click.prevent="reveal({{ $vocab->id }})"
      >？</a>
      <div class="text-muted">
        @foreach (explode(', ', $vocab->kana) as $kana)
          <div class="leading-none whitespace-no-wrap {{ $showLabels || @$visible[$vocab->id] ? '' : 'invisible hidden md:block' }}">
            【{{ $kana }}】
          </div>
        @endforeach
      </div>
      <div class="{{ $showLabels || @$visible[$vocab->id] ? '' : 'invisible hidden md:block' }}">
        {{ $vocab->meaning }}
      </div>
      @auth
        <a
          class="mb-6 md:mb-0 md:px-2 md:py-1 md:text-right {{ $showLabels || @$visible[$vocab->id] ? '' : 'invisible hidden md:block' }}"
          href="#"
          wire:click.prevent="burn({{ $vocab->id }})"
        >
          <span class="{{ $vocab->burnable === null ? 'text-red-600 hover:text-red-800' : 'text-gray-600 hover:text-gray-800' }}">
            @svg (flame)
          </span>
        </a>
      @else
        <span></span>
      @endauth
    @endforeach
  </div>
</div>
