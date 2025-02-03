<?php /** @var \App\Livewire\JsonFormatter $this */ ?>

<div class="grid grid-cols-2 gap-8">
  <textarea class="the-input font-mono text-xs h-[50vh] select-all" wire:model.live="json"></textarea>

  <textarea class="the-input font-mono text-xs h-[50vh]">{{ $this->formattedJson() }}</textarea>
</div>
