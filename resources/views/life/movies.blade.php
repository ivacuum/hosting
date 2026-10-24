<?php /** @var \App\FavoriteMovie $movie */ ?>

@extends('life.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">
  @ru
    Фильмы и сериалы, достойные многократного просмотра
  @en
    Movies and TV series worth rewatching
  @endru
</h1>
<p>
  @ru
    Под годом ниже подразумевается год выпуска, а не год просмотра.
  @en
    Years below are release years, not viewing years.
  @endru
</p>

@foreach ($moviesByYears as $year => $movies)
  <div class="movies-container {{ !$loop->first ? 'mt-12' : '' }}">
    <div class="font-medium text-2xl mb-2">
      @ru
        {{ $year }} год
      @en
        {{ $year }}
      @endru
    </div>
    @include('tpl.kp_movies')
  </div>
@endforeach
@endsection
