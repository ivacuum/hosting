/** @namespace App.map.ym.ObjectManager */

export default class PhotosMap {
  static load(container = 'photos_map') {
    const $el = $(`#${container}`)

    if (!$el.length) return

    App.map
      .create(container, $el.data('lat'), $el.data('lon'), $el.data('zoom'), true)
      .then(() => {
        const manager = new App.map.ym.ObjectManager({
          clusterize: $el.data('clusterize'),
          gridSize: $el.data('cluster_size'),
        })

        manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
        manager.clusters.options.set('preset', 'islands#nightClusterIcons')

        App.map.map.geoObjects.add(manager)

        fetch($el.data('action'), {
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
