/* global VueI18n */
import './bootstrap'

import throttle from 'lodash/throttle'
import Map from 'vac-gfe/js/yandex-map'
import Pjax from 'vac-gfe/js/pjax'
import YandexMetrika from 'vac-gfe/js/yandex-metrika'
import router from './router'
import store from './store/store'
import AcpApp from './components/AcpApp.vue'
import AcpI18n from './i18n/acp'
import svg from './svg-icons'

import NewsViewsObserver from './news-views-observer'
import TorrentsViewsObserver from './torrents-views-observer'

import 'vac-gfe/js/jquery.batch-form'
import 'vac-gfe/js/jquery.bottom-tabbar'
import 'vac-gfe/js/jquery.confirm'
import 'vac-gfe/js/jquery.dblclick-edit'
import 'vac-gfe/js/jquery.entity-action'
import 'vac-gfe/js/jquery.highlight'
import 'vac-gfe/js/jquery.password-eye'
import 'vac-gfe/js/jquery.select-all'

import Beacon from './beacon'
import EventHandlers from './events'
import PhotosMap from './photos-map'
import Shortcuts from './shortcuts'
import YandexDns from './yandex-dns'

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
    const { self } = document.body.dataset

    if (self.startsWith('Acp\\')) {
      this.vue = new Vue({
        el: '#app',
        i18n: new VueI18n({
          locale: this.options.locale,
          messages: AcpI18n,
          fallbackLocale: 'en',
          silentTranslationWarn: true,
        }),
        store,
        render: h => h(AcpApp),
        router,

        data() {
          return {
            svg,
          }
        },
      })
    } else {
      this.vue = new Vue({
        el: '#pjax_container',
        i18n: new VueI18n({
          locale: this.options.locale,
        }),
      })
    }
  }

  static lazyLoadImages() {
    const offset = 1000
    const breakpoint = 1200

    const $w = $(window)
    const $body = $(document.body)
    const width = $w.width()
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
            const src = width > breakpoint ? (e.data('src2x') || e.data('src')) : e.data('src')
            e.attr('src', src)
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
