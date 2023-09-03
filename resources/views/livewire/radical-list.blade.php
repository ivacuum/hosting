<?php /** @var \App\Livewire\RadicalList $this */ ?>

<div>
  @if ($this->radicals->count())
    <div class="sm:flex items-center justify-between mt-6 mb-1">
      <h3 class="font-medium text-2xl mb-2">
        <span>{{ $this->range ? __('Уровень :level', ['level' => $this->level]) : __('japanese.radicals') }}</span>
        <span class="text-base text-muted">{{ $this->radicals->count() }}</span>
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
    <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8 gap-px text-center text-white">
      @foreach ($this->radicals as $radical)
        <div class="group rounded {{ auth()->id() && $radical->burnable ? 'bg-burned' : 'bg-radical' }} {{ auth()->id() && !$this->showBurned && $radical->burnable ? 'hidden' : '' }}">
          <a class="block text-6xl leading-none py-2 text-white hover:text-grey-200" href="{{ $radical->www() }}">
            @if ($radical->character)
              <div class="ja-shadow">
                {{ $radical->character }}
              </div>
            @else
              <div class="ja-image-shadow ja-svg">
                @svg (wk/$radical->meaning)
              </div>
            @endif
          </a>
          <div class="ja-shadow-light capitalize pb-2 {{ $this->showLabels ? '' : 'invisible group-hover:visible' }}">
            {{ $radical->meaning }}
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
