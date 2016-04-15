@extends('life.trips.base')

@section('content')
<p>Перелет из открытого несколькими месяцами ранее крохотного аэропорта Грабцево в Калуге.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1824.jpg'])

<p>Через два с лишним часа уже в центре Петербурга. Сам полет занимает немногим более часа.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1811.jpg'])

<p>Раз в день в крупных сетях кинотеатров показывают кино в оригинале с субтитрами. Сеансы не самые удобные для гостей города — между 6 и 8 часами вечера. При покупке билета сервис удостоверяется в вашей уверенности смотреть фильм на иностранном языке.</p>
<div class="img-container shortcuts-item">
  <img class="js-lazy" data-src="https://life.ivacuum.ru/spb.2015.10/english.png" data-src-2x="https://life.ivacuum.ru/spb.2015.10/english.png" width="846" height="550" src="https://life.ivacuum.ru/0.gif">
</div>

<p>За оплату Мастеркардом дают скидку. Не узнал бы, если бы не нажал ради интереса на список вариантов оплаты.</p>
<div class="img-container shortcuts-item">
  <img class="js-lazy" data-src="https://life.ivacuum.ru/spb.2015.10/discount.png" data-src-2x="https://life.ivacuum.ru/spb.2015.10/discount.png" width="541" height="259" src="https://life.ivacuum.ru/0.gif">
</div>

<p>По итогу присылают код билета. Его достаточно поднести к терминалу Яндекса у входа в кинозал, к контролеру обращаться не нужно.</p>
<div class="img-container shortcuts-item">
  <img class="js-lazy" data-src="https://life.ivacuum.ru/spb.2015.10/qr.png" data-src-2x="https://life.ivacuum.ru/spb.2015.10/qr.png" width="607" height="220" src="https://life.ivacuum.ru/0.gif">
</div>

<p>В городе приятно.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_1816.jpg',
  'IMG_1817.jpg',
]])

<p>Несколько высотных видов.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_1823.jpg',
  'IMG_1813.jpg',
]])

<p>Безмятежно прогуливающаяся парочка.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1818.jpg'])

<p>Балконы с возможностью зайти за угол.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1821.jpg'])

<p>В вестибюле метро есть куда выбросить чеки. На самих подземных станциях урн не наблюдается с <a class="link" href="https://meduza.io/feature/2015/11/20/metro-bez-urn-samolety-bez-zhidkostey">1977 года</a>.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1822.jpg'])

<p>Типичная картина списка доступных беспроводных сетей дома. Не всегда даже на экран ноутбука влезает.</p>
<div class="img-container shortcuts-item">
  <img class="js-lazy" data-src="https://life.ivacuum.ru/spb.2015.10/wi-fi.png" data-src-2x="https://life.ivacuum.ru/spb.2015.10/wi-fi.png" width="296" height="586" src="https://life.ivacuum.ru/0.gif">
</div>

<p>Рядом с домом сетей может быть в несколько раз больше. Почему? Близкое к окну расположение роутера, максимальная (100%) мощность сигнала в его настройках. В идеале поместить роутер в недра квартиры, снизить мощность до минимальной, при которой сохраняется стабильное подключение устройств. Так будет меньше помех и вам и соседям. Выставить стандарт связи вроде 802.11n — он выбирается по минимальному поддерживаемому среди устройств дома. Подробнее <a class="link" href="https://habrahabr.ru/post/149447/">о нюансах работы вай-фая</a>.</p>
@endsection
