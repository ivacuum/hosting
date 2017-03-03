@extends('life.gigs.base')

{{-- Yotaspace --}}

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>Новый тур группы Oomph! Это будет уже шестое выступление по счету в Москве. Сетлист будет известен вместе с первым концертом в Санкт-Петербурге 24 марта.</p>
      <p>В своем Фэйсбуке участники группы <a class="link" href="https://www.facebook.com/oomphband/videos/10154365026933803/">пообещали</a> исполнить одну песню, которая никогда не звучала на просторах СНГ. Также будет несколько песен в новой обработке. Без хитов публика тоже не останется.</p>
      <p>Ждем-с.</p>
      <p>
        <a class="btn btn-primary" href="https://ponominalu.ru/event/oomph">Купить билет</a>
        <a class="btn btn-default" href="https://vk.com/oomph_msk">Группа ВК</a>
        <a class="btn btn-default" href="https://www.treehouse-ticketing.com/cat/index/sCategory/95">Meet&Greet</a>
      </p>
    @endlang
    {{--
    @include('tpl.setlist-title')
    <ol>
      <li>—</li>
    </ol>
    --}}
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/oomph.2017.03.26.jpg">
    </div>
  </div>
</div>
@endsection
