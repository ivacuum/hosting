@extends('life.trips.base')

@section('content')
@ru
  <p>В конце 2015 года междугородним автобусам запретили въезжать в Кёльн, автовокзал переместился в Леверкузен.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1135.jpg'])

@ru
  <p>Маленький городишко с узкими улицами.</p>
@en
  <p>Small town with narrow streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1124.jpg',
  'IMG_1126.jpg',
  'IMG_1128.jpg',
]])

@ru
  <p>Пешеходной зоной.</p>
@en
  <p>With pedestrian zone.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1125.jpg'])

@ru
  <p>Симпатичными домиками.</p>
@en
  <p>And attractive houses.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1130.jpg',
  'IMG_1131.jpg',
]])

@ru
  <p>Остановится автобус — остановится и весь поток. И это норма так проектировать, у нас скорее всего бы сделали карман.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1132.jpg'])

@ru
  <p>Несмотря на наличие островков безопасности, пешеходный переход на одном уровне с дорогой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1133.jpg'])

@ru
  <p>Мой автобус опоздал на 3 часа, в качестве извинений перевозчик предоставил ваучер на бесплатную поездку по Европе.</p>
@endru

{{--
Диалог с водителем:
— Do you speak english?
— Nein. Sprechen sie Spanish?
— Nein. ¯\_(ツ)_/¯
--}}
@endsection
