@extends('life.gigs.base')

{{-- Bud Arena --}}

@section('content')
@ru
  <p>Меньше площадку для выступления международно известной группы еще поискать. Сет подобран на удивление масштабный — выступление преодолело отметку полутора часов, что для Продиджи не совсем типично. Начался концерт аж только в 21:40. Звук был относительно тихий, прорезавшись на треках Diesel Power и Smack My Bitch Up. Попрыгали знатно на всех песнях сета. Давка в гардеробе по окончании была куда жестче, чем слэм перед сценой.</p>
@endlang

@ru
  <p>Стоило ли идти? Разок определенно интересно увидеть каков он этот рейв. Если бы цена билета была не 4 400 ₽, а вдвое меньше, то можно было бы однозначно всем рекомендовать сходить. Публика очень активная.</p>
@endlang

<div class="row">
  <div class="col-md-7">
    @include('tpl.setlist-title')
    <ol>
      <li>Breathe</li>
      <li>Nasty</li>
      <li>Omen</li>
      <li>Wild Frontier</li>
      <li>Firestarter</li>
      <li>Roadblox</li>
      <li>Rok-Weiler</li>
      <li>The Day Is My Enemy</li>
      <li>Voodoo People</li>
      <li>Get Your Fight On</li>
      <li>Run With the Wolves</li>
      <li>Invaders Must Die</li>
      <li>Poison</li>
      <li>Everybody in the Place</li>
      <li>Diesel Power</li>
      <li>Smack My Bitch Up</li>
      <li>Their Law</li>
      <li>No Good (Start the Dance)</li>
      <li>Wall of Death</li>
      <li>Take Me to the Hospital</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/prodigy.2016.11.09.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись концерта. На 54:12 разглядел свой затылок.</p>
@en
  <p>Video of the show. Saw back of my head on 54:12.</p>
@endlang
<youtube title="The Prodigy, Moscow 2016" v="HND1SuZMseY"></youtube>
@endsection
