@extends('life.gigs.base')

@section('content')
@ru
  {{--
  <div class="mb-2">
    @include('tpl.gig-countdown', ['show_datetime' => '2019-08-02 19:00:00'])
  </div>
  --}}
  <p>Новый тур группы Rammstein. Семнадцатое выступление по счету в России и шестое в СПб. В этот раз концерт в поддержку нового студийного альбома под названием Rammstein, выпущенного 17 мая. Место проведения концерта: стадион «Санкт-Петербург».</p>
  {{--
  <p>
    <a class="btn btn-primary" href="http://tci.ru/rammstein2019/">Купить билет</a>
    <a class="btn btn-default" href="https://vk.com/rammstein2019">Группа ВК</a>
  </p>
  --}}
@endru
<div class="row">
  <div class="col-md-7">
    @include('tpl.setlist-title')
    <ol>
      <li>Was ich liebe</li>
      <li>Links 2-3-4</li>
      <li>Tattoo</li>
      <li>Sehnsucht</li>
      <li>Zeig dich</li>
      <li>Mein Herz brennt</li>
      <li>Puppe</li>
      <li>Heirate mich</li>
      <li>Diamant</li>
      <li>Deutschland (RMX by Richard Z. Kruspe)</li>
      <li>Deutschland</li>
      <li>Radio</li>
      <li>Mein Teil</li>
      <li>Du hast</li>
      <li>Sonne</li>
      <li>Ohne dich</li>
      <li>Engel</li>
      <li>Ausländer</li>
      <li>Du riechst so gut</li>
      <li>Pussy</li>
      <li>Rammstein</li>
      <li>Ich will</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.org/gigs/rammstein.2019.08.02.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись концерта.</p>
@en
  <p>Video of the show.</p>
@endru
<youtube title="Rammstein 2019, Saint Petersburg, Russia" v="5XRMVf9YyKI"></youtube>
@endsection
