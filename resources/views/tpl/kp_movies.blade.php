<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($movies as $movie)
    <a class="tw-w-1/2 sm:tw-w-1/3 md:tw-w-1/4 xl:tw-w-1/5 screenshot-link tooltipped tooltipped-n tw-pr-1 tw-pb-1"
       aria-label="{{ $movie['title'] ?? '' }}"
       href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/">
      <img class="screenshot" src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg">
    </a>
  @endforeach
</div>
