<?php /** @var \App\Photo $photo */ ?>

@extends('photos.base')

@section('content')
<div
  id="photos_map"
  class="photo-map-container -mx-4 sm:mx-0 -mb-6"
  data-action="{{ fullUrl() }}"
  data-lat="{{ $photo->point->lat ?? Request::input('lat', 52) }}"
  data-lon="{{ $photo->point->lon ?? Request::input('lon', 30) }}"
  data-zoom="{{ $photo !== null ? 17 : Request::input('zoom', 4) }}"
  data-clusterize="{{ Request::input('clusterize', 1) }}"
  data-cluster-size="{{ Request::input('cluster-size', 64) }}"
></div>
@endsection
