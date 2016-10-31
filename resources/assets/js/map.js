export default class {
  constructor(locale) {
    this.api_version = 2.1
    this.loaded = false
    this.locale = this.getYandexLocale(locale)
    this.map = null
    this.onload = 'App.map.onloadCallback'
    this.ym = null
  }

  create(el, lat, lon, zoom = 10) {
    return this.load().then(() => {
      this.map = new this.ym.Map(el, {
        center: [lat, lon],
        zoom: zoom,
        controls: ['zoomControl', 'fullscreenControl'],
      }, {
        suppressMapOpenBlock: true,
      })

      this.map.behaviors.disable('scrollZoom')
    })
  }

  load() {
    return new Promise((resolve) => {
      if (this.loaded) {
        resolve()
        return
      }

      this.appendJsToHead(`https://api-maps.yandex.ru/${this.api_version}/?lang=${this.locale}&onload=${this.onload}&ns=`)

      let timer = window.setInterval(() => {
        if (this.loaded) {
          window.clearInterval(timer)
          resolve()
        }
      }, 1000)
    })
  }

  onloadCallback(ymaps) {
    this.loaded = true
    this.ym = ymaps
  }

  // Вспомогательное
  appendJsToHead(src) {
    let el = document.createElement('script')
    el.type = 'text/javascript'
    el.src = src
    el.async = true
    document.getElementsByTagName('head')[0].appendChild(el)
  }

  getYandexLocale(locale) {
    switch (locale) {
      case 'en': return 'en_US'
    }

    return 'ru_RU'
  }
}
