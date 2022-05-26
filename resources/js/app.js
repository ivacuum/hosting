import Map from './yandex-map'
import YandexMetrika from './yandex-metrika'

import NewsViewsObserver from './news-views-observer'
import TorrentsViewsObserver from './torrents-views-observer'

import './dblclick-edit'
import './batch-form'
import './bottom-tabbar'
import './entity-action'
import './password-eye'
import './select-all'

import Beacon from './beacon'
import EventHandlers from './events'
import PhotosMap from './photos-map'
import Shortcuts from './shortcuts'
import initVueComponents from './vue-init-components'

/**
 * @namespace window.AppOptions
 * @property {string} locale
 * @property {boolean} loggedIn
 * @property {string} csrfToken
 * @property {number} yandexMetrikaId
 */

class Application {
  constructor() {
    this.options = window.AppOptions

    this.beacon = new Beacon(this.options.csrfToken)
    this.locale = this.options.locale
    this.map = new Map(this.locale)
    this.metrika = new YandexMetrika(this.options.yandexMetrikaId)
    this.vue = null

    this.initOnReady()

    document.addEventListener('DOMContentLoaded', () => {
      EventHandlers.bind()
      Shortcuts.bind()

      this.constructor.conditionalInit()
      this.beacon.bind()
    })
  }

  static conditionalInit() {
    const { route } = document.body.dataset

    if (route === 'news') {
      const observer = NewsViewsObserver()
      observer.observe()
    } else if (route === 'photos/map') {
      PhotosMap.load()
    } else if (route === 'magnets') {
      const observer = TorrentsViewsObserver()
      observer.observe()
    }
  }

  /*
  errorHandler() {
    window.addEventListener('error', function (e) {
      console.log(e)
    })
  }
  */

  initVue() {
    initVueComponents('#pjax_container', this.options.locale)
  }

  initOnReady() {
    this.initVue()
  }
}

window.App = new Application()
