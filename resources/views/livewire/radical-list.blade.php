<?php /** @var \App\Radical $radical */ ?>

<div>
  @if ($radicals->count())
    <div class="sm:flex items-center justify-between mt-6 mb-1">
      <h3>
        <span>{{ $range ? __('Уровень :level', ['level' => $level]) : __('japanese.radicals') }}</span>
        <span class="text-base text-muted">{{ $radicals->count() }}</span>
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
      @foreach ($radicals as $radical)
        <div class="group rounded {{ auth()->id() && $radical->burnable ? 'bg-burned' : 'bg-radical' }}">
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
          <div class="ja-shadow-light capitalize pb-2 {{ $showLabels ? '' : 'invisible group-hover:visible' }}">
            {{ $radical->meaning }}
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
