@extends('photos.base')

@section('content')
<div id="photos_map" class="photo-map-container"></div>
@endsection

@push('js')
<script>
$(function () {
  let points = <?php echo json_encode($collection); ?>

  App.map.create('photos_map', {{ Request::input('lat', 52) }}, {{ Request::input('lon', 30) }}, {{ Request::input('zoom', 4) }}, true)
    .then(() => {
      let manager = new App.map.ym.ObjectManager({
        clusterize: {{ Request::input('clusterize', true) }},
        gridSize: {{ Request::input('cluster-size', 64) }}
      })

      manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
      manager.clusters.options.set('preset', 'islands#nightClusterIcons')

      App.map.map.geoObjects.add(manager)

      manager.add(points)
    })
})
</script>
@endpush
