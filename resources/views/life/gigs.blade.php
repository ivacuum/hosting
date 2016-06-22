@extends('life.base', [
  'meta_title' => 'Посещенные и ожидаемые концерты',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты'],
  ]
])

@section('content')
<h2>Посещенные и ожидаемые концерты</h2>
<p>Началось все с установки по концерту в год, но в 2014 что-то пошло не так...</p>

<div class="travel-entry">
  <span class="travel-year">2016</span>
  David Gilmour
  <span class="travel-month">18 июля</span>
</div>

<div class="travel-entry">
  Rammstein
  <span class="travel-month">9 июля</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/rammstein.2016.06">Rammstein</a>
  <span class="travel-month">19 июня</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2015</span>
  <a class="link" href="/life/oomph.2015">Oomph!</a>
  <span class="travel-month">4 ноября</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/linkinpark.2015">Linkin Park</a>
  <span class="travel-month">29 августа</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/metallica.2015">Metallica</a>
  <span class="travel-month">25 августа</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/dreamtheater.2015">Dream Theater</a>
  <span class="travel-month">3 июля</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2014</span>
  <a class="link" href="/life/tfn.2014">Tides from Nebula</a>
  <span class="travel-month">21 декабря</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/giaa.2014">God is an Astronaut</a>
  <span class="travel-month">23 ноября</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/linkinpark.2014">Linkin Park</a>
  <span class="travel-month">2 июня</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/vai.2014">Steve Vai</a>
  <span class="travel-month">26 мая</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/dreamtheater.2014.msk">Dream Theater</a>
  <span class="travel-month">28 февраля</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/dreamtheater.2014.spb">Dream Theater</a>
  <span class="travel-month">26 февраля</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2013</span>
  <a class="link" href="/life/oomph.2013">Oomph!</a>
  <span class="travel-month">19 октября</span>
</div>

<div class="travel-entry">
  <a class="link" href="/life/rammstein.2013">Rammstein</a>
  <span class="travel-month">8 июня</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2012</span>
  <a class="link" href="/life/oomph.2012">Oomph!</a>
  <span class="travel-month">24 мая</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2011</span>
  <a class="link" href="/life/dreamtheater.2011">Dream Theater</a>
  <span class="travel-month">12 июля</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2010</span>
  <a class="link" href="/life/rammstein.2010">Rammstein</a>
  <span class="travel-month">26 февраля</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2009</span>
  <a class="link" href="/life/dreamtheater.2009">Dream Theater</a>
  <span class="travel-month">10 июня</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2008</span>
  <a class="link" href="/life/metallica.2008">Metallica</a>
  <span class="travel-month">18 июля</span>
</div>

<div class="travel-entry">
  <span class="travel-year">2007</span>
  <a class="link" href="/life/oomph.2007">Oomph!</a>
  <span class="travel-month">21 апреля</span>
</div>
@endsection
