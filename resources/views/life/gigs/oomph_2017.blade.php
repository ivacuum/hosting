@extends('life.gigs.base')

{{-- Yotaspace --}}

@section('content')
{{--
@ru
  <p>Новый тур группы Oomph! Это будет уже шестое выступление по счету в Москве. Сетлист будет известен вместе с первым концертом в Санкт-Петербурге 24 марта.</p>
  <p>В своем Фэйсбуке участники группы <a class="link" href="https://www.facebook.com/oomphband/videos/10154365026933803/">пообещали</a> исполнить одну песню, которая никогда не звучала на просторах СНГ. Также будет несколько песен в новой обработке. Без хитов публика тоже не останется.</p>
  <p>Ждем-с.</p>
  <p>
    <a class="btn btn-primary" href="https://ponominalu.ru/event/oomph">Купить билет</a>
    <a class="btn btn-default" href="https://vk.com/oomph_msk">Группа ВК</a>
    <a class="btn btn-default" href="https://www.treehouse-ticketing.com/cat/index/sCategory/95">Meet&Greet</a>
  </p>
@endru
--}}
<div class="md:tw-flex md:tw--mx-4">
  <div class="md:tw-w-7/12 md:tw-px-4">
    @include('tpl.setlist-title')
    <ol>
      <li>Das weisse Licht</li>
      <li>Gott ist ein Popstar</li>
      <li>Träumst Du</li>
      <li>Mein Schatz</li>
      <li>Der neue Gott</li>
      <li>Bis der Spiegel zerbricht</li>
      <li>Als wärs das letzte Mal</li>
      <li>Sandmann</li>
      <li>Gekreuzigt</li>
      <li>Jetzt oder nie</li>
      <li>
        Sex hat keine Macht
        <span class="tw-text-sm text-muted">(Acoustic)</span>
      </li>
      <li>Jede Reise hat ein Ende</li>
      <li>Mein Herz</li>
      <li>Niemand</li>
      <li>Mitten ins Herz</li>
      <li>Aus meiner Haut</li>
      <li>Kleinstadtboy</li>
      <li>
        Fieber
        <span class="tw-text-sm text-muted">(Acoustic)</span>
      </li>
      <li>
        Das letzte Streichholz
        <span class="tw-text-sm text-muted">(Acoustic)</span>
      </li>
      <li>Давай, давай работай</li>
      <li>Labyrinth</li>
      <li>Augen auf!</li>
      <li>Alles aus Liebe</li>
      <li>Auf Kurs</li>
    </ol>
  </div>
  <div class="md:tw-w-5/12 md:tw-px-4">
    <div class="tw-mb-6 tw-text-center tw-mobile-wide">
      <img class="image-fit-viewport tw-max-w-full sm:tw-rounded" src="https://life.ivacuum.org/gigs/oomph.2017.03.26.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись выступления.</p>
@endru
<youtube title="Oomph 2017, Moscow, Russia" v="Apm0ySyi7mA"></youtube>
@endsection
