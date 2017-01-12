@extends('life.gigs.base')

{{-- СК Олимпийский --}}

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>Смело можно сказать, что два вокалиста в группе — это ад! Не дадут спуска практически ни на минуту. Прокричишь куплет, припев будешь уже прыгать и орать, далее все заново. И так 100 минут. Стоило оно того? Однозначно да!</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Guilty All the Same</li>
      <li>Given Up</li>
      <li>Points of Authority</li>
      <li>One Step Closer</li>
      <li>Blackout</li>
      <li>Papercut</li>
      <li>With You</li>
      <li>Runaway</li>
      <li>Wastelands</li>
      <li>Castle of Glass</li>
      <li>Leave Out All the Rest / Shadow of the Day / Iridescent</li>
      <li>Robot Boy</li>
      <li>Joe Hahn Solo</li>
      <li>Burn It Down</li>
      <li>Waiting for the End</li>
      <li>Wretches and Kings / Remember the Name / When They Come for Me</li>
      <li>Numb</li>
      <li>In the End</li>
      <li>Faint</li>
      <li>Until It's Gone</li>
      <li>A Light That Never Comes</li>
      <li>Lost in the Echo</li>
      <li>Crawling</li>
      <li>New Divide</li>
      <li>What I've Done</li>
      <li>Bleed It Out</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/linkinpark.2014.06.02.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозаписи с концерта: полное шоу, флэшмоб (трек #19) и medley (трек #11).</p>
@endlang
<div class="js-lazy" data-lazy-type="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/watch?v=rLB0aIGS0zE"></a>
  <a href="https://www.youtube.com/watch?v=NdIBg8zHRFI"></a>
  <a href="https://vk.com/video_ext.php?oid=169906990&id=168576241&hash=1112fdc7c48b81fc&hd=3" data-video="true">
    <img src="https://pp.vk.me/c540406/u15466377/video/l_d7946cfb.jpg">
  </a>
</div>
@endsection
