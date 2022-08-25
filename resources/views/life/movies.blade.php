<?php /** @var \App\FavoriteMovie $movie */ ?>

@extends('life.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">Фильмы и сериалы, достойные многократного просмотра</h1>
<p>Под годом ниже подразумевается год выпуска, а не год просмотра.</p>

@foreach ($moviesByYears as $year => $movies)
  <div class="movies-container {{ !$loop->first ? 'mt-12' : '' }}">
    <div class="font-medium text-2xl mb-2">{{ $year }} год</div>
    @include('tpl.kp_movies')
  </div>
@endforeach
@endsection
