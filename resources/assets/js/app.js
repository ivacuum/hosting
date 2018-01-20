import './bootstrap'

import Map from 'vac-gfe/js/yandex-map'
import Pjax from 'vac-gfe/js/pjax'
import YandexMetrika from 'vac-gfe/js/yandex-metrika'

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

import './dcpp'
import './events'
import './life'
import './shortcuts'
import './yandex-dns'

let throttle = require('lodash/throttle')

class Application {
  constructor() {
    const options = window['AppOptions']

    this.beacon_data = []
    this.locale = options.locale
    this.map = new Map(this.locale)
    this.metrika = new YandexMetrika(options.yandexMetrikaId)
    this.pjax = new Pjax()

    this.ajaxProgress()
    this.csrfToken()
    this.onPjaxComplete()
    this.onPjaxSend()

    $(() => {
      this.initOnReadyAndPjax()
      this.lazyLoadImages()

      this.conditionalInit()
      this.sendBeaconDataOnUnload()
    })
  }

  ajaxProgress() {}

  autosizeTextareas() {
    autosize($('.js-autosize-textarea'))
  }

  conditionalInit() {
    const view = document.body.dataset.view
    const self = document.body.dataset.self

    if (view === 'news.index') {
      const observer = NewsViewsObserver()
      observer.observe()
    } else if (view === 'torrents.index') {
      const observer = TorrentsViewsObserver()
      observer.observe()
    }
  }

  csrfToken() {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': window['AppOptions'].csrfToken }
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
    new Vue({
      el: '#pjax_container'
    })
  }

  lazyLoadImages() {
    const offset = 1000
    const breakpoint = 1200

    let $w = $(window)
    let $body = $(document.body)
    let $images

    const width = $w.width()

    function initLazyLoad() {
      $images = $('.js-lazy')

      $w.off('.js-lazy')
        .on('scroll.js-lazy resize.js-lazy', throttle(performLazyLoad, 500))

      performLazyLoad()
    }

    function performLazyLoad() {
      const scrolled_down = $w.scrollTop() + $w.height() + offset
      const scrolled_up = $w.scrollTop() - offset

      $images = $images.filter(function() {
        let e = $(this)
        let type = $(this).data('lazy-type') || 'image'
        const image_offset = e.offset().top

        if (image_offset < scrolled_down && image_offset > scrolled_up) {
          e.removeClass('js-lazy')

          if (type === 'image') {
            const src = width > breakpoint ? (e.data('src2x') || e.data('src')) : e.data('src')
            e.attr('src', src)
          } else if (type === 'fotorama') {
            $('img', e).each(function() {
              $(this).attr('src', $(this).data('src'))
            })

            e.fotorama()
          } else if (type === 'fotorama-2x') {
            if (width > breakpoint) {
              $('a', e).each(function() {
                $(this).attr('href', $(this).data('src2x'))
              })

              $('img', e).each(function() {
                $(this).attr('src', $(this).data('src2x'))
              })
            } else {
              $('img', e).each(function() {
                $(this).attr('src', $(this).data('src'))
              })
            }

            e.fotorama()
          }

          return false
        }

        return true
      })

      if (!$images.length) {
        $w.off('.js-lazy')
      }
    }

    $body.off('reset.js-lazy').on('reset.js-lazy', initLazyLoad)

    initLazyLoad()
  }

  initOnReadyAndPjax(pjax = false) {
    this.initVue()
    this.autosizeTextareas()
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
    $(document).on('pjax:send', (e) => this.pjax.onSend(e))
  }

  sendBeaconDataOnUnload() {
    if (navigator.sendBeacon) {
      window.addEventListener('unload', () => {
        if (this.beacon_data.length === 0) {
          return
        }

        let data = new FormData()

        data.append('events', JSON.stringify(this.beacon_data))
        data.append('_token', window['AppOptions'].csrfToken)

        navigator.sendBeacon('/ajax/beacon', data)
      })
    }
  }
}

window.App = new Application
