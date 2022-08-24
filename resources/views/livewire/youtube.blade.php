<?php /** @var \App\Http\Livewire\Youtube $this */ ?>

<div class="-mt-4 mb-4 relative">
  @if (!$this->expanded)
    <span class="text-red-700">
      @svg (play)
    </span>
    <a class="pseudo" wire:click.prevent="expand">@lang('Открыть видео :title', ['title' => $this->title])</a>
  @else
    <div>
      <span class="text-red-700">
        @svg (times)
      </span>
      <a class="pseudo" wire:click.prevent="shrink">@lang('Закрыть видео :title', ['title' => $this->title])</a>
    </div>
    <div class="mt-2 mb-6 -mx-4 sm:mx-0 relative" style="padding-bottom: 56.25%">
      <iframe
        class="absolute inset-0 w-full h-full"
        src="https://www.youtube.com/embed/{{ $this->v }}?autoplay=1{{ $this->start }}"
        frameborder="0"
        allowfullscreen
      ></iframe>
    </div>
  @endif
</div>
