<?php /** @var \App\FavoriteMovie $movie */ ?>

@extends('life.base', [
  'metaTitle' => 'Любимые фильмы и сериалы',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Любимые фильмы и сериалы'],
  ]
])

@section('content')
<h1 class="h2">Фильмы и сериалы, достойные многократного просмотра</h1>
<p>Под годом ниже подразумевается год выпуска, а не год просмотра.</p>

@foreach ($moviesByYears as $year => $movies)
  <div class="movies-container {{ !$loop->first ? 'mt-12' : '' }}">
    <div class="h3">{{ $year }} год</div>
    @include('tpl.kp_movies')
  </div>
@endforeach
@endsection
