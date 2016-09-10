@foreach ($movies as $movie)
  <a class="tip" data-html="true" title="{{ $movie['title'] or '' }}" href="https://www.kinopoisk.ru/film/{{ $movie['id'] }}/">
    <img class="screenshot" src="https://st.kp.yandex.net/images/film_big/{{ $movie['id'] }}.jpg" height="250">
  </a>
@endforeach
