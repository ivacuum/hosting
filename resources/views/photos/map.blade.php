@extends('photos.base')

@section('content')
<div id="photos_map"
     class="photo-map-container"
     data-action="{{ fullUrl() }}"
     data-lat="{{ Request::input('lat', 52) }}"
     data-lon="{{ Request::input('lon', 30) }}"
     data-zoom="{{ Request::input('zoom', 4) }}"
     data-clusterize="{{ Request::input('clusterize', 1) }}"
     data-cluster_size="{{ Request::input('cluster-size', 64) }}"></div>
@endsection
