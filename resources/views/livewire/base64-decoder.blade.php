<?php /** @var \App\Livewire\Base64Decoder $this */ ?>

<div class="grid grid-cols-2 gap-8">
  <textarea class="form-input font-mono text-xs h-[50vh] select-all" wire:model.live="input"></textarea>

  <textarea class="form-input font-mono text-xs h-[50vh]">{{ $this->decode() }}</textarea>
</div>
