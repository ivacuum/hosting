import './bootstrap'

import Map from './map'
import Pjax from './pjax'
import YandexMetrika from './yandex-metrika'

import './events'
import './highlight'
import './life'
import './shortcuts'
import './vue'
import './yandex-dns'

let throttle = require('lodash.throttle')

class Application {
  constructor() {
    const options = window['AppOptions']

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
    })
  }

  ajaxProgress() {}

  autosizeTextareas() {
    autosize($('.js-autosize-textarea'))
  }

  csrfToken() {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': window['AppOptions'].csrfToken }
    })
  }

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
      const scrolled = $w.scrollTop() + $w.height() + offset

      $images = $images.filter(function() {
        let e = $(this)
        let type = $(this).data('lazy-type') || 'image'

        if (scrolled > e.offset().top) {
          e.removeClass('js-lazy')

          if (type === 'image') {
            const src = width > breakpoint ? (e.data('src2x') || e.data('src')) : e.data('src')
            e.attr('src', src)
          } else if (type === 'fotorama') {
            e.fotorama()
          } else if (type === 'fotorama-2x') {
            if (width > breakpoint) {
              $('a', e).each(function() {
                $(this).attr('href', $(this).data('src2x'))
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
      this.metrika.pjaxHit()
      this.pjax.onComplete()

      this.initOnReadyAndPjax(true)

      // Нужно вызывать после this.initVue(), иначе
      // перестает работать метод offset() на картинках
      $(document.body).trigger('reset.js-lazy')
    })
  }

  onPjaxSend() {
    $(document).on('pjax:send', () => this.pjax.onSend())
  }
}

window.App = new Application
