<?php /** @var \App\Http\Livewire\BurnKanji $this */ ?>

<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $this->burned ? __('japanese.resurrect') : __('japanese.burn-kanji') }}</button>
</div>
