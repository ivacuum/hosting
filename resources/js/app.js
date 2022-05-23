import throttle from 'lodash/throttle'
import Map from './yandex-map'
import YandexMetrika from './yandex-metrika'

import NewsViewsObserver from './news-views-observer'
import TorrentsViewsObserver from './torrents-views-observer'

import './dblclick-edit'
import './jquery.batch-form'
import './jquery.bottom-tabbar'
import './jquery.entity-action'
import './jquery.password-eye'
import './jquery.select-all'

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

    this.csrfToken()
    this.initOnReady()

    $(() => {
      this.constructor.lazyLoadImages()

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

  csrfToken() {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': this.options.csrfToken },
    })
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

  static lazyLoadImages() {
    const offset = 1000

    const $w = $(window)
    const $body = $(document.body)
    let $images

    function performLazyLoad() {
      const scrolledUp = $w.scrollTop() - offset
      const scrolledDown = $w.scrollTop() + $w.height() + offset

      $images = $images.filter(function lazyLoadImagesFilter() {
        const e = $(this)
        const type = $(this).data('lazy-type') || 'image'
        const imageOffset = e.offset().top

        if (imageOffset < scrolledDown && imageOffset > scrolledUp) {
          e.removeClass('js-lazy')

          if (type === 'image') {
            e.attr('srcset', e.data('srcset'))
          }

          return false
        }

        return true
      })

      if (!$images.length) {
        $w.off('.js-lazy')
      }
    }

    function initLazyLoad() {
      $images = $('.js-lazy')

      $w.off('.js-lazy')
        .on('scroll.js-lazy resize.js-lazy', throttle(performLazyLoad, 500))

      performLazyLoad()
    }

    $body.off('reset.js-lazy').on('reset.js-lazy', initLazyLoad)

    initLazyLoad()
  }

  initOnReady() {
    this.initVue()
  }
}

window.App = new Application()
