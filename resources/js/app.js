import Map from './yandex-map'

import NewsViewsObserver from './news-views-observer'
import MagnetsViewsObserver from './magnets-views-observer'

import './dblclick-edit'
import './batch-form'
import './bottom-tabbar'
import './entity-action'
import './password-eye'
import './select-all'

import Beacon from './beacon'
import EventHandlers from './events'
import PhotosMap from './photos-map'
import PhotoViewer from './photo-viewer'
import Shortcuts from './shortcuts'

/**
 * @namespace window.AppOptions
 * @property {string} locale
 * @property {string} csrfToken
 */

class Application {
  constructor() {
    this.options = window.AppOptions

    this.beacon = new Beacon(this.options.csrfToken)
    this.locale = this.options.locale
    this.map = new Map(this.locale)
    this.photoViewer = new PhotoViewer()

    document.addEventListener('DOMContentLoaded', () => {
      EventHandlers.bind()
      Shortcuts.bind()

      this.constructor.conditionalInit()
      this.beacon.bind()
      this.photoViewer.bind()
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
      const observer = MagnetsViewsObserver()
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
}

window.App = new Application()
