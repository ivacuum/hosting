<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

$part = (int) request('part', 1);

$paginator = new LengthAwarePaginator(range(1, 4), 4, 1, Paginator::resolveCurrentPage('part'))
    ->withPath(Paginator::resolveCurrentPath())
    ->setPageName('part');
?>

@extends('life.trips.base')

@section('content')
  <div class="flex items-center gap-4 mb-2">
    <div>@ru Части: @en Parts: @endru</div>
    {{ $paginator->links('tpl.trip-story-pagination') }}
  </div>

  @if($part === 1)
    @include('life.trips.singapore_2023-part-1')
  @elseif($part === 2)
    @include('life.trips.singapore_2023-part-2')
  @elseif($part === 3)
    @include('life.trips.singapore_2023-part-3')
  @elseif($part === 4)
    @include('life.trips.singapore_2023-part-4')
  @endif

  @if(in_array($part, [1, 2, 3]))
    @ru
      <p>В истории о Сингапуре получилось настолько много фотографий, что понадобилось разбить ее на четыре части для комфортного просмотра.</p>
    @en
      <p>The story about Singapore has so many photos that it had to be divided into four parts for comfortable viewing.</p>
    @endru
  @endif
  <div class="flex items-center gap-4">
    <div>@ru Части: @en Parts: @endru</div>
    {{ $paginator->links('tpl.trip-story-pagination') }}
  </div>
@endsection
