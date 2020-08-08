<div class="-mt-4 mb-4 relative">
  @if (!$expanded)
    <span class="text-red-700">
      @svg (play)
    </span>
    <a class="pseudo" wire:click.prevent="expand">{{ __('Открыть видео :title', ['title' => $title]) }}</a>
  @else
    <div>
      <span class="text-red-700">
        @svg (times)
      </span>
      <a class="pseudo" wire:click.prevent="shrink">{{ __('Закрыть видео :title', ['title' => $title]) }}</a>
    </div>
    <div class="mt-2 mb-6 mobile-wide relative" style="padding-bottom: 56.25%">
      <iframe
        class="absolute inset-0 w-full h-full"
        src="https://www.youtube.com/embed/{{ $v }}?autoplay=1{{ $start }}"
        frameborder="0"
        allowfullscreen
      ></iframe>
    </div>
  @endif
</div>
