import PhotoPoints from './photo-points'

export default class PhotosMap {
  static load(container = 'photos_map') {
    const el = document.querySelector(`#${container}`)

    if (!el) return

    const data = el.dataset

    // Точки скачиваются одновременно с API карт
    const points = PhotoPoints.fetch(data.action)

    App.map
      .create(container, data.lat, data.lon, data.zoom, true)
      .then(() => {
        const manager = PhotoPoints.createManager({
          clusterize: data.clusterize,
          gridSize: data.clusterSize,
        })

        App.map.map.geoObjects.add(manager)
        // https://yandex.ru/dev/maps/jsbox/2.1/show_visible_objects
        // https://yandex.ru/dev/maps/jsapi/doc/2.1/dg/concepts/loading-object-manager/about.html

        return points.then(collection => manager.add(collection))
      })
  }
}
