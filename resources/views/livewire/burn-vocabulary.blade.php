<?php /** @var \App\Domain\Wanikani\Livewire\BurnVocabulary $this */ ?>

<div>
  <button
    class="btn btn-default"
    wire:click="toggleBurned"
  >{{ $this->burned ? __('japanese.resurrect') : __('japanese.burn-vocabulary') }}</button>
</div>
