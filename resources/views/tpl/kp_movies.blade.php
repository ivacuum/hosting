<div
  class="grid gap-1 mobile-wide overflow-x-scroll"
  style="grid-template-columns: repeat({{ sizeof($movies) }}, max-content); grid-template-rows: 350px;"
>
  @foreach ($movies as $movie)
    <a
      class="screenshot-link tooltipped tooltipped-n"
      aria-label="{{ $movie['title'] ?? '' }}"
      href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/"
    >
      <img
        class="screenshot"
        src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg"
        alt=""
        style="height: 350px;"
      >
    </a>
  @endforeach
</div>
