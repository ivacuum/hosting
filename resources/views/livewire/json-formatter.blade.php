<?php /** @var \App\Http\Livewire\JsonFormatter $this */ ?>

<div class="grid grid-cols-2 gap-8">
  <textarea class="form-input h-[50vh] select-all" wire:model="json"></textarea>

  <textarea class="form-input h-[50vh]">{{ $this->formattedJson() }}</textarea>
</div>
