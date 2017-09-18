@extends('life.trips.base')

@section('content')
@ru
  <p>Перелет из открытого несколькими месяцами ранее крохотного аэропорта Грабцево в Калуге.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1824.jpg'])

@ru
  <p>Через два с лишним часа уже в центре Петербурга. Сам полет занимает немногим более часа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1811.jpg'])

@ru
  <p>Раз в день в крупных сетях кинотеатров показывают кино в оригинале с субтитрами. Сеансы не самые удобные для гостей города — между 6 и 8 часами вечера. При покупке билета сервис удостоверяется в вашей уверенности смотреть фильм на иностранном языке.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'english.png', 'w' => 846, 'h' => 550])

@ru
  <p>За оплату МастерКардом дают скидку. Не узнал бы, если бы не нажал ради интереса на список вариантов оплаты.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'discount.png', 'w' => 541, 'h' => 259])

@ru
  <p>По итогу присылают код билета. Его достаточно поднести к терминалу Яндекса у входа в кинозал, к контролеру обращаться не нужно.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'qr.png', 'w' => 607, 'h' => 220])

@ru
  <p>В городе приятно.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1816.jpg',
  'IMG_1817.jpg',
]])

@ru
  <p>Несколько высотных видов.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1823.jpg',
  'IMG_1813.jpg',
]])

@ru
  <p>Безмятежно прогуливающаяся парочка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1818.jpg'])

@ru
  <p>Балконы с возможностью зайти за угол.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1821.jpg'])

@ru
  <p>В вестибюле метро есть куда выбросить чеки. На самих подземных станциях урн не наблюдается с <a class="link" href="https://meduza.io/feature/2015/11/20/metro-bez-urn-samolety-bez-zhidkostey">1977 года</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1822.jpg'])

@ru
  <p>Типичная картина списка доступных беспроводных сетей дома. Не всегда даже на экран ноутбука влезает.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'wi-fi.png', 'w' => 296, 'h' => 586])

@ru
  <p>Рядом с домом сетей может быть в несколько раз больше. Почему? Близкое к окну расположение роутера, максимальная (100%) мощность сигнала в его настройках. В идеале поместить роутер в недра квартиры, снизить мощность до минимальной, при которой сохраняется стабильное подключение устройств. Так будет меньше помех и вам и соседям. Выставить стандарт связи вроде 802.11n — он выбирается по минимальному поддерживаемому среди устройств дома. Подробнее <a class="link" href="https://habrahabr.ru/post/149447/">о нюансах работы вай-фая</a>.</p>
@endru
@endsection
