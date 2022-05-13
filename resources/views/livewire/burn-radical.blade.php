<?php /** @var \App\Http\Livewire\BurnRadical $this */ ?>

<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $this->burned ? __('japanese.resurrect') : __('japanese.burn-radical') }}</button>
</div>
