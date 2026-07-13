<?php /** @var \App\Livewire\Youtube $this */ ?>

<div class="-mt-4 mb-4 relative" x-data="{ expanded: false }">
  <template x-if="!expanded">
    <span>
      <span class="text-red-700">
        @svg (play)
      </span>
      <a class="pseudo" x-on:click.prevent="expanded = true; App.beacon.push({ event: 'YoutubeOpened' })">@lang('Открыть видео :title', ['title' => $this->title])</a>
    </span>
  </template>
  <template x-if="expanded">
    <div>
      <div>
        <span class="text-red-700">
          @svg (times)
        </span>
        <a class="pseudo" x-on:click.prevent="expanded = false; App.beacon.push({ event: 'YoutubeClosed' })">@lang('Закрыть видео :title', ['title' => $this->title])</a>
      </div>
      <div class="mt-2 mb-6 -mx-4 sm:mx-0 relative" style="padding-bottom: 56.25%">
        <iframe
          class="absolute inset-0 w-full h-full"
          src="https://www.youtube.com/embed/{{ $this->v }}?autoplay=1{{ $this->start }}"
          frameborder="0"
          allowfullscreen
        ></iframe>
      </div>
    </div>
  </template>
</div>
