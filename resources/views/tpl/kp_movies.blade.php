<div class="d-flex flex-wrap mobile-wide">
  @foreach ($movies as $movie)
    <a class="flex-basis-50 flex-sm-basis-33 flex-md-basis-25 flex-xl-basis-20 screenshot-link tooltipped tooltipped-n tw-pr-1 tw-pb-1"
       aria-label="{{ $movie['title'] ?? '' }}"
       href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/">
      <img class="screenshot" src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg">
    </a>
  @endforeach
</div>
