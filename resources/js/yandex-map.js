export default class {
  constructor(locale = 'ru') {
    this.api_version = 2.1
    this.loading = null
    this.locale = this.getYandexLocale(locale)
    this.map = null
    this.onload = 'App.map.onloadCallback'
    this.ym = null
  }

  centeredPlacemark(properties = {}, options = {}) {
    return this.placemark(this.map.getCenter(), properties, options)
  }

  create(el, lat, lon, zoom = 10, scrollZoom = false) {
    return this.load().then(() => {
      this.map = new this.ym.Map(
        el,
        {
          center: [lat, lon],
          zoom,
          controls: ['zoomControl', 'fullscreenControl'],
        },
        {
          suppressMapOpenBlock: true,
          yandexMapDisablePoiInteractivity: true,
        },
      )

      if (scrollZoom === false) {
        this.map.behaviors.disable('scrollZoom')
      }
    })
  }

  createByBounds(el, bounds) {
    return this.load().then(() => {
      this.map = new this.ym.Map(
        el,
        {
          bounds,
          controls: ['zoomControl', 'fullscreenControl'],
        },
        {
          suppressMapOpenBlock: true,
          restrictMapArea: false,
          yandexMapDisablePoiInteractivity: true,
        },
      )

      this.map.behaviors.disable('scrollZoom')
    })
  }

  load() {
    this.loading ??= new Promise((resolve) => {
      this.resolveLoading = resolve

      this.appendJsToHead(
        `https://api-maps.yandex.ru/${this.api_version}/?lang=${this.locale}&onload=${this.onload}&ns=`,
      )
    })

    return this.loading
  }

  mapGeocodeOnClick(point, callback) {
    this.map.events.add('click', (e) => {
      const coords = e.get('coords')
      point.geometry.setCoordinates(coords)

      this.ym.geocode(coords, { results: 1 }).then(callback)
    })
  }

  onloadCallback(ymaps) {
    this.ym = ymaps
    this.resolveLoading()
  }

  placemark(coords, properties = {}, options = {}) {
    const point = new this.ym.Placemark(coords, properties, options)
    this.map.geoObjects.add(point)
    return point
  }

  pointGeocodeOnDragEnd(point, callback) {
    point.events.add('dragend', () => {
      this.ym
        .geocode(point.geometry.getCoordinates(), { results: 1 })
        .then(callback)
    })
  }

  setCenter(coords) {
    if (!this.map) {
      return
    }

    this.map.setCenter(coords)
  }

  // Вспомогательное
  appendJsToHead(src) {
    const el = document.createElement('script')
    el.type = 'text/javascript'
    el.src = src
    el.async = true
    document.getElementsByTagName('head')[0].appendChild(el)
  }

  getYandexLocale(locale) {
    switch (locale) {
      case 'en':
        return 'en_US'
    }

    return 'ru_RU'
  }
}
