@extends('life.base', [
  'meta_title' => 'Страны',
])

@section('content')
  <h2>Посещенные страны</h2>
  <ul class="list-inline trips-show-by">
    <li><a class="link" href="/life">по годам</a></li>
    <li><mark>по странам</mark></li>
    <li><a class="link" href="/life/cities">по городам</a></li>
  </ul>

  @if (!empty($countries))
    <ol>
      @foreach ($countries as $country)
        <li>
          <a class="link" href="/life/countries/{{ $country->slug }}">
            {{ $country->title }}
          </a>
        </li>
      @endforeach
    </ol>
  @endif
@endsection
