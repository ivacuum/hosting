@foreach ($movies as $movie)
  <a class="d-inline-block screenshot-link tooltipped tooltipped-n"
     aria-label="{{ $movie['title'] ?? '' }}"
     href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/">
    <img class="screenshot"
         src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg"
         height="250">
  </a>
@endforeach
