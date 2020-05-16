@extends('life.trips.base')

@section('content')
@ru
  <p>Покатались по Западу, пора и домой.</p>
@endru

@ru
  <p>Германия.</p>
@en
  <p>Germany.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2954.jpg',
  'IMG_2955.jpg',
]])

@ru
  <p>Пит-стоп в Польше на закате.</p>
@en
  <p>Pit-stop in Poland at sunset.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2966.jpg',
  'IMG_2968.jpg',
  'IMG_2974.jpg',
]])

@ru
  <p>Макдак регулярно был спонсором интернета для построения маршрутов с учетом пробок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2976.jpg'])

@ru
  <p>Беларусь.</p>
@en
  <p>Belarus.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2978.jpg'])

@ru
  <p>Россия.</p>
@en
  <p>Russia.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2982.jpg'])

@ru
  <p>Крапивна.</p>
@en
  <p>Krapivna.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2983.jpg',
  'IMG_2985.jpg',
  'IMG_2986.jpg',
  'IMG_2989.jpg',
]])

@ru
  <p>Концовка пути самая стрессовая — всего одна полоса, никаких разделителей, ограничение 90 км/ч, дороги известно какого качества. Если бы машина ехала сама, то водителя вполне могли бы успокоить пейзажи за окном.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2990.jpg',
  'IMG_2992.jpg',
  'IMG_2993.jpg',
  'IMG_3001.jpg',
  'IMG_3012.jpg',
]])

@ru
  <p>Калуга.</p>
@en
  <p>Kaluga.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3031.jpg'])

@ru
  <p>За неделю было посещено 13 городов, пробег 6&thinsp;000 км, сделано 839 фоток и записано 11 небольших видосов. Пешком пройдено лишь 65 км. При наличии второго водителя реально за 30 часов домчать до Брюгге или обратно.</p>
@endru

@ru
  <p>Шоколад не выдержал парилки в салоне, поэтому превратился в жидкий.</p>
@endru
<livewire:youtube title="Hot Chocolate" v="ThNnFs0DG9g"/>
@endsection
