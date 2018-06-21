@extends('life.gigs.base')

{{-- Ray Just Arena --}}

@section('content')
@ru
  <p>Фестиваль музыки в стиле прогрессив метал с хэдлайнерами в лице Дрим Театра. Ограничение по времени фестивальных выступлений коснулось и их — сет был всего на полтора часа, когда <a class="link" href="dreamtheater.2014.spb">годом ранее</a> они играли три.</p>
  <p>Укрепилось впечатление, что музыкантам Москва нравится больше Питера по их активности на соответствующих шоу и вниманию к публике.</p>
  <p>Интересно составлен сет — по одной песне с каждого выпущенного альбома с 1989 по 2013 годы. Молодцы, что вернули в программу As I Am и Panic Attack — их нехватало с <a class="link" href="dreamtheater.2009">2009 года</a>.</p>
@endru
<div class="row">
  <div class="col-md-7">
    @include('tpl.setlist-title')
    <ol>
      <li>Afterlife</li>
      <li>Metropolis Pt. 1: The Miracle and the Sleeper</li>
      <li>Caught in a Web</li>
      <li>A Change of Seasons: II Innocence</li>
      <li>Burning My Soul</li>
      <li>The Spirit Carries On</li>
      <li>About to Crash</li>
      <li>As I Am</li>
      <li>Panic Attack</li>
      <li>Constant Motion</li>
      <li>Wither</li>
      <li>Bridges in the Sky</li>
      <li>Behind the Veil</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/dreamtheater.2015.07.03.jpg">
    </div>
  </div>
</div>

@ru
  <p>Несколько фото с концерта.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'IMG_1682.jpg', 'w' => 1000, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => 'IMG_1688.jpg', 'w' => 1000, 'h' => 750])
@include('tpl.pic-arbitrary', ['pic' => 'IMG_1689.jpg', 'w' => 1000, 'h' => 750])

@ru
  <p class="mb-1">Видеозапись выступления.</p>
@endru
<youtube title="Dream Theater 2015, Moscow, Russia" v="w0ZYxUeKsu8"></youtube>
@endsection
