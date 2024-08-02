<?php /** @var \App\FavoriteMovie $movie */ ?>

<div
  class="grid gap-x-4 snap-x sm:mx-0 overflow-x-scroll"
  style="grid-template-columns: repeat({{ count($movies) }}, max-content); grid-template-rows: 400px;"
>
  @foreach ($movies as $movie)
    <a
      class="screenshot-link snap-start tooltipped tooltipped-n"
      aria-label="{{ $movie->title_ru }} / {{ $movie->title_en }}"
      href="{{ $movie->externalLink() }}"
    >
      <img
        class="screenshot h-[400px]"
        src="{{ $movie->cover() }}"
        loading="lazy"
        alt=""
      >
    </a>
  @endforeach
</div>
