<?php /** @var \App\Http\Livewire\Base64Encoder $this */ ?>

<div class="grid grid-cols-2 gap-8">
  <textarea class="form-input font-mono text-xs h-[50vh] select-all" wire:model="input"></textarea>

  <textarea class="form-input font-mono text-xs h-[50vh]">{{ $this->encode() }}</textarea>
</div>
