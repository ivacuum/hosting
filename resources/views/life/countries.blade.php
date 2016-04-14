@extends('life.base', [
  'meta_title' => 'Страны',
])

@section('content')
  <h2>Посещенные страны</h2>

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
