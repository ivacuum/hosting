<?php /** @var \App\Radical $radical */ ?>

<div>
  @if ($radicals->count())
    <div class="sm:flex items-center justify-between mt-6 mb-1">
      <h3>
        <span>{{ $range ? __('Уровень :level', ['level' => $level]) : trans('japanese.radicals') }}</span>
        <span class="text-base text-muted">{{ $radicals->count() }}</span>
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
    <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8 gap-px text-center text-white">
      @foreach ($radicals as $radical)
        <div class="group rounded {{ $radical->burnable === null ? 'bg-radical' : 'bg-burned' }}">
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
