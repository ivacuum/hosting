@extends('base')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">Полигон на карте</h1>
<div
  id="map_polygon"
  class="h-[70vh] -mx-4 sm:mx-0 mb-6"
></div>

<div>
  <label class="block mb-1 font-semibold">WKT</label>
  <input id="polygon_wkt" class="form-input select-all" type="text" value="" readonly>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('#map_polygon')

  App.map
    .create(container, 54.507014, 36.252277, 10, true)
    .then(() => {
      const myPolygon = new App.map.ym.Polygon([], {}, {
          editorDrawingCursor: 'crosshair',
          editorMaxPoints: 100,
          fillColor: 'rgba(255, 255, 255, .7)',
          strokeColor: '#337ab7',
          strokeWidth: 3
      })

      App.map.map.geoObjects.add(myPolygon)

      myPolygon.events.add('geometrychange', () => {
        const coordinates = App.map.map.geoObjects.get(0).geometry.getCoordinates()

        if (coordinates.length === 0) {
          return
        }

        const wkt = coordinates
          .map((lineCircle) => {
            const lineCircleWkt = lineCircle
              .map((point) => `${Number.parseFloat(point[1]).toFixed(5)} ${Number.parseFloat(point[0]).toFixed(5)}`)
              .join(',')

            return `(${lineCircleWkt})`
          })
          .join(',')

        document.querySelector('#polygon_wkt').value = `POLYGON(${wkt})`
      })

      myPolygon.editor.startDrawing()
    })
})
</script>
@endsection
