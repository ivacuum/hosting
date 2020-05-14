@extends('life.trips.base')

@section('content')
@ru
  <p>Прогулка к бору и около него в период красочной золотой осени.</p>
@en
  <p>A walk to and around the pine forest during the golden fall.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1354.jpg',
  'IMG_1356.jpg',
  'IMG_1357.jpg',
  'IMG_1358.jpg',
  'IMG_1363.jpg',
  'IMG_1364.jpg',
  'IMG_1365.jpg',
  'IMG_1368.jpg',
  'IMG_1370.jpg',
  'IMG_1371.jpg',
  'IMG_1376.jpg',
  'IMG_1378.jpg',
  'IMG_1379.jpg',
  'IMG_1380.jpg',
  'IMG_1387.jpg',
  'IMG_1388.jpg',
  'IMG_1389.jpg',
  'IMG_1390.jpg',
  'IMG_1391.jpg',
  'IMG_1392.jpg',
  'IMG_1393.jpg',
  'IMG_1394.jpg',
  'IMG_1395.jpg',
  'IMG_1396.jpg',
  'IMG_1397.jpg',
]])
@endsection
