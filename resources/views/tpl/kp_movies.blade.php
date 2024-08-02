<?php /** @var \App\FavoriteMovie $movie */ ?>

<div
  class="grid gap-x-4 snap-x sm:mx-0 overflow-x-scroll"
  style="grid-template-columns: repeat({{ count($movies) }}, max-content);"
>
  @foreach ($movies as $movie)
    <a
      class="screenshot-link snap-start"
      href="{{ $movie->externalLink() }}"
    >
      <img
        class="screenshot h-[400px]"
        src="{{ $movie->cover() }}"
        loading="lazy"
        alt=""
      >
      <div class="mt-2 mb-4">
        <div>{{ $movie->title_ru }}</div>
        <div class="text-sm">{{ $movie->title_en }}</div>
      </div>
    </a>
  @endforeach
</div>
