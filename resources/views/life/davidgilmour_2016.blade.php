@extends('life.base', [
  'meta_title' => 'David Gilmour в Висбадене &middot; 18 июля 2016',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/davidgilmour.2016.07.18.png',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'David Gilmour']
  ]
])

@section('content')
<h2>David Gilmour в Висбадене <small>18 июля 2016</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Что играли:</p>
    <ol>
      <li>5 A.M.</li>
      <li>Rattle That Lock</li>
      <li>Faces of Stone</li>
      <li>Wish You Were Here</li>
      <li>What Do You Want From Me</li>
      <li>A Boat Lies Waiting</li>
      <li>The Blue</li>
      <li>Money</li>
      <li>Us and Them</li>
      <li>In Any Tongue</li>
      <li>High Hopes</li>
      <li>One of These Days</li>
      <li>Shine On You Crazy Diamond (Parts I-V)</li>
      <li>Dancing Right in Front of Me</li>
      <li>Coming Back to Life</li>
      <li>On an Island</li>
      <li>The Girl in the Yellow Dress</li>
      <li>Today</li>
      <li>Sorrow</li>
      <li>Run Like Hell</li>
      <li>Time</li>
      <li>Breathe (Reprise)</li>
      <li>Comfortably Numb</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/davidgilmour.2016.07.18.png">
    </div>
  </div>
</div>

{{--
@include('life.timeline.davidgilmour')
--}}
@endsection
