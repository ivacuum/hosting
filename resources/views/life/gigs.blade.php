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

<table class="table-stats">
  <thead>
    <tr>
      <th>Дата</th>
      <th>Группа</th>
      <th>Город</th>
    </tr>
  </thead>
  <tbody>
    <tr class="text-muted">
      <td>18 июля 2016</td>
      <td>David Gilmour</td>
      <td>Висбаден</td>
    </tr>
    <tr class="text-muted">
      <td>9 июля 2016</td>
      <td>Rammstein</td>
      <td>Берлин</td>
    </tr>
    <tr class="text-muted">
      <td>19 июня 2016</td>
      <td><a class="link" href="/life/rammstein.2016.06">Rammstein</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>4 ноября 2015</td>
      <td><a class="link" href="/life/oomph.2015">Oomph!</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>29 августа 2015</td>
      <td><a class="link" href="/life/linkinpark.2015">Linkin Park</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>25 августа 2015</td>
      <td><a class="link" href="/life/metallica.2015">Metallica</a></td>
      <td><a class="link" href="/life/spb">Санкт-Петербург</a></td>
    </tr>
    <tr>
      <td>3 июля 2015</td>
      <td><a class="link" href="/life/dreamtheater.2015">Dream Theater</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>21 декабря 2014</td>
      <td><a class="link" href="/life/tfn.2014">Tides from Nebula</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>23 ноября 2014</td>
      <td><a class="link" href="/life/giaa.2014">God is an Astronaut</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>2 июня 2014</td>
      <td><a class="link" href="/life/linkinpark.2014">Linkin Park</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>26 мая 2014</td>
      <td><a class="link" href="/life/vai.2014">Steve Vai</a></td>
      <td><a class="link" href="/life/kaluga">Калуга</a></td>
    </tr>
    <tr>
      <td>28 февраля 2014</td>
      <td><a class="link" href="/life/dreamtheater.2014.msk">Dream Theater</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>26 февраля 2014</td>
      <td><a class="link" href="/life/dreamtheater.2014.spb">Dream Theater</a></td>
      <td><a class="link" href="/life/spb">Санкт-Петербург</a></td>
    </tr>
    <tr>
      <td>19 октября 2013</td>
      <td><a class="link" href="/life/oomph.2013">Oomph!</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>8 июня 2013</td>
      <td><a class="link" href="/life/rammstein.2013">Rammstein</a></td>
      <td>Самара</td>
    </tr>
    <tr>
      <td>24 мая 2012</td>
      <td><a class="link" href="/life/oomph.2012">Oomph!</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>12 июля 2011</td>
      <td><a class="link" href="/life/dreamtheater.2011">Dream Theater</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>26 февраля 2010</td>
      <td><a class="link" href="/life/rammstein.2010">Rammstein</a></td>
      <td><a class="link" href="/life/spb">Санкт-Петербург</a></td>
    </tr>
    <tr>
      <td>10 июня 2009</td>
      <td><a class="link" href="/life/dreamtheater.2009">Dream Theater</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
    <tr>
      <td>18 июля 2008</td>
      <td><a class="link" href="/life/metallica.2008">Metallica</a></td>
      <td><a class="link" href="/life/spb">Санкт-Петербург</a></td>
    </tr>
    <tr>
      <td>21 апреля 2007</td>
      <td><a class="link" href="/life/oomph.2007">Oomph!</a></td>
      <td><a class="link" href="/life/msk">Москва</a></td>
    </tr>
  </tbody>
</table>
@stop
