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
        <li class="countries-list-country">
          <a class="link" href="/life/countries/{{ $country->slug }}">{{ $country->title }}</a>:
          @php ($total_cities = sizeof($country->cities) - 1)
          @foreach ($country->cities as $i => $city)
            <a class="link" href="/life/{{ $city->slug }}">{{ $city->title }}</a>{{ $i !== $total_cities ? ',' : '' }}
          @endforeach
        </li>
      @endforeach
    </ol>
  @endif
@endsection
