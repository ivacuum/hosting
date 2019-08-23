@extends('life.gigs.base')

{{-- ГлавClub --}}

@section('content')
<div class="md:tw-flex md:tw--mx-4">
  <div class="md:tw-w-7/12 md:tw-px-4">
    @ru
      <p>Повторение <a class="link" href="opeth.2016">брюссельской программы</a> в укороченном виде — тогда исполнение было лучше, а у нас зато всегда активная и громкая публика по сравнению с европейской. В целом концерт можно было пропускать — увидеть одно шоу тура достаточно.</p>
    @endru
    @include('tpl.setlist-title')
    <ol>
      <li>Sorceress</li>
      <li>Ghost of Perdition</li>
      <li>Demon of the Fall</li>
      <li>The Wilde Flowers</li>
      <li>In My Time of Need</li>
      <li>Cusp of Eternity</li>
      <li>Heir Apparent</li>
      <li>The Drapery Falls</li>
      <li>Deliverance</li>
    </ol>
  </div>
  <div class="md:tw-w-5/12 md:tw-px-4">
    <div class="img-container">
      <img src="https://life.ivacuum.org/gigs/opeth.2017.10.11.jpg">
    </div>
  </div>
</div>

@ru
  <p class="tw-mb-1">Видеозапись выступления.</p>
@endru
<youtube title="Opeth 2017, Moscow, Russia" v="URhBcvRpt14"></youtube>
@endsection
