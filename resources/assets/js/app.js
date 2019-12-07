import './bootstrap'

import throttle from 'lodash/throttle'
import Map from 'vac-gfe/js/yandex-map'
import Pjax from 'vac-gfe/js/pjax'
import YandexMetrika from 'vac-gfe/js/yandex-metrika'

import NewsViewsObserver from './news-views-observer'
import TorrentsViewsObserver from './torrents-views-observer'

import 'vac-gfe/js/jquery.batch-form'
import 'vac-gfe/js/jquery.bottom-tabbar'
import 'vac-gfe/js/jquery.dblclick-edit'
import 'vac-gfe/js/jquery.entity-action'
import 'vac-gfe/js/jquery.password-eye'
import 'vac-gfe/js/jquery.select-all'

import Beacon from './beacon'
import EventHandlers from './events'
import PhotosMap from './photos-map'
import Shortcuts from './shortcuts'
import YandexDns from './yandex-dns'
import initVueAcpSpa from './vue-init-acp-spa'
import initVueAppSpa from './vue-init-app-spa'
import initVueComponents from './vue-init-components'

/**
 * @namespace window.AppOptions
 * @property {string} locale
 * @property {boolean} loggedIn
 * @property {string} csrfToken
 * @property {string} socketIoHost
 * @property {number} yandexMetrikaId
 */

class Application {
  constructor() {
    this.options = window.AppOptions

    this.beacon = new Beacon(this.options.csrfToken)
    this.locale = this.options.locale
    this.map = new Map(this.locale)
    this.metrika = new YandexMetrika(this.options.yandexMetrikaId)
    this.pjax = new Pjax()
    this.vue = null

    this.csrfToken()
    this.onPjaxComplete()
    this.onPjaxSend()

    $(() => {
      this.initOnReadyAndPjax()
      this.constructor.lazyLoadImages()

      EventHandlers.bind()
      Shortcuts.bind()
      YandexDns.bind()

      this.constructor.conditionalInit()
      this.beacon.bind()
    })
  }

  static autosizeTextareas(selector = '.js-autosize-textarea') {
    autosize(document.querySelectorAll(selector))
  }

  static conditionalInit() {
    const { view } = document.body.dataset

    if (view === 'news.index') {
      const observer = NewsViewsObserver()
      observer.observe()
    } else if (view === 'photos.map') {
      PhotosMap.load()
    } else if (view === 'torrents.index') {
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
    initVueAcpSpa('#vue_acp', this.options.locale)
    initVueAppSpa('#vue_app', this.options.locale)
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

  initOnReadyAndPjax() {
    this.initVue()
    this.constructor.autosizeTextareas()
  }

  onPjaxComplete() {
    $(document).on('pjax:complete', () => {
      $('.js-flash-notification .alert').alert('close')

      this.metrika.pjaxHit()
      this.pjax.onComplete()

      this.initOnReadyAndPjax(true)

      // Нужно вызывать после this.initVue(), иначе
      // перестает работать метод offset() на картинках
      $(document.body).trigger('reset.js-lazy')
    })
  }

  onPjaxSend() {
    $(document).on('pjax:send', e => this.pjax.onSend(e))
  }
}

window.App = new Application()
