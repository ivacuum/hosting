<?php
/**
 * @var \App\Domain\Game\Models\Game $game
 */
?>

@extends('base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Игры')</h1>
@ru
  <p>Мысли и скриншоты о попробованных и пройденных играх.</p>
@en
  <p>Thoughts and screenshots about games I've tried or beaten.</p>
@endru

@if (count($games))
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 mb-8">
    @foreach ($games as $game)
      <div>
        <a class="screenshot-link link-parent" href="@lng/games/{{ $game->slug }}">
          <img class="block screenshot aspect-2/3" src="{{ $game->libraryImage() }}" alt="" loading="lazy">
          <div class="mt-1 link">
            {{ $game->title }}
          </div>
        </a>
      </div>
    @endforeach
  </div>

  @include('tpl.paginator', ['paginator' => $games])
@else
  @ru
    <p>На сайте пока нет игр.</p>
  @en
    <p>There are no games right now on this site.</p>
  @endru
@endif
@endsection
