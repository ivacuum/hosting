<?php /** @var \App\FavoriteMovie $movie */ ?>

<div
  class="grid gap-1 -mx-4 sm:mx-0 overflow-x-scroll"
  style="grid-template-columns: repeat({{ count($movies) }}, max-content); grid-template-rows: 350px;"
>
  @foreach ($movies as $movie)
    <a
      class="screenshot-link tooltipped tooltipped-n"
      aria-label="{{ $movie->title_ru }} / {{ $movie->title_en }}"
      href="{{ $movie->externalLink() }}"
    >
      <img
        class="screenshot"
        src="{{ $movie->cover() }}"
        alt=""
        style="height: 350px;"
      >
    </a>
  @endforeach
</div>
