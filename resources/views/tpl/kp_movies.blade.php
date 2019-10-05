<div class="flex flex-wrap mobile-wide">
  @foreach ($movies as $movie)
    <a class="w-1/2 sm:w-1/3 md:w-1/4 xl:w-1/5 screenshot-link tooltipped tooltipped-n pr-1 pb-1"
       aria-label="{{ $movie['title'] ?? '' }}"
       href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/">
      <img class="screenshot" src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg" alt="">
    </a>
  @endforeach
</div>
