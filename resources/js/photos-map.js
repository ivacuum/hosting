/** @namespace App.map.ym.ObjectManager */

export default class PhotosMap {
  static load(container = 'photos_map') {
    const el = document.querySelector(`#${container}`)

    if (!el) return

    const data = el.dataset

    App.map
      .create(container, data.lat, data.lon, data.zoom, true)
      .then(() => {
        const manager = new App.map.ym.ObjectManager({
          clusterize: data.clusterize,
          gridSize: data.clusterSize,
        })

        manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
        manager.clusters.options.set('preset', 'islands#nightClusterIcons')

        App.map.map.geoObjects.add(manager)

        fetch(data.action, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
        })
          .then(response => response.json())
          .then(json => manager.add(json))
      })
  }
}
