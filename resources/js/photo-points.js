/** @namespace App.map.ym.ObjectManager */

export default class PhotoPoints {
  static createManager(options = {}) {
    const manager = new App.map.ym.ObjectManager({
      clusterize: 1,
      gridSize: 64,
      ...options,
    })

    manager.objects.options.set('preset', 'islands#nightCircleDotIcon')
    manager.clusters.options.set('preset', 'islands#nightClusterIcons')

    return manager
  }

  static fetch(url) {
    return fetch(url, {
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
    })
      .then(response => response.json())
      .then(json => this.toFeatureCollection(json))
  }

  /**
   * Разворачивает компактный ответ сервера в GeoJSON для ObjectManager
   */
  static toFeatureCollection({ groups, points }) {
    const groupsHtml = groups.map(([url, caption, thumbnailFolder]) => ({
      url: this.escape(url),
      caption: this.escape(caption),
      thumbnailFolder: this.escape(thumbnailFolder),
    }))

    return {
      type: 'FeatureCollection',
      features: points.map(([lat, lon, groupIndex, filename], id) => {
        const group = groupsHtml[groupIndex]
        const file = this.escape(filename)

        return {
          type: 'Feature',
          id,
          geometry: {
            type: 'Point',
            coordinates: [lat, lon],
          },
          properties: {
            balloonContent: `<div><a href="${group.url}#${file}">${group.caption}<br><img class="mt-1 image-200 object-cover rounded" src="${group.thumbnailFolder}/${file}" alt=""></a></div><div class="mt-1">${lat}, ${lon}</div>`,
            clusterCaption: file,
          },
        }
      }),
    }
  }

  static escape(text) {
    return text
      .replaceAll('&', '&amp;')
      .replaceAll('<', '&lt;')
      .replaceAll('>', '&gt;')
      .replaceAll('"', '&quot;')
      .replaceAll('\'', '&#039;')
  }
}
