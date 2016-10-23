import Map from './map'
import Pjax from './pjax'

import './events'
import './life'
import './modal-feedback'
import './shortcuts'
import './yandex-dns'

window.Vue = require('vue')
require('vue-resource')

Vue.http.interceptors.push((request, next) => {
  request.headers.set('X-CSRF-TOKEN', window['AppOptions'].csrfToken)

  next()
})

class Application {
  constructor() {
    this.locale = window['AppOptions'].locale
    this.map = new Map(this.locale)
    this.pjax = new Pjax()

    this.ajaxProgress()
    this.csrfToken()
    this.onPjaxComplete()
    this.onPjaxSend()

    $(document).ready(() => {
      this.lazyLoadImages()
      this.initOnReadyAndPjax()
    })
  }

  ajaxProgress() {
    $(document).ajaxStart(() => NProgress.start())
    $(document).ajaxStop(() => NProgress.done())
  }

  autosizeTextareas() {
    autosize($('.js-autosize-textarea'))
  }

  csrfToken() {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': window['AppOptions'].csrfToken }
    })
  }

  fotoramaInit(pjax = false) {
    if (pjax) {
      $('.fotorama').fotorama()
    }

    this.fotorama2x()

    $('.js-fotorama-2x').fotorama()
  }

  fotorama2x() {
    const breakpoint = 1200

    let width = $(window).width()

    if (width >= breakpoint) {
      $('.js-fotorama-2x a').each(function() {
        $(this).attr('href', $(this).data('src2x'))
      })
    }
  }

  lazyLoadImages() {
    const offset = 400
    const breakpoint = 1200

    let $w = $(window),
        $body = $(document.body),
        images,
        timer

    const width = $w.width()

    function initLazyLoad() {
      images = $('.js-lazy')

      $w.off('.js-lazy').on('scroll.js-lazy resize.js-lazy', () => timer || (timer = setTimeout(performLazyLoad, 150)))

      performLazyLoad()
    }

    function performLazyLoad() {
      const scrolled = $w.scrollTop() + $w.height() + offset

      images = images.filter(function() {
        let e = $(this)
        const src = width > breakpoint ? (e.data('src2x') || e.data('src')) : e.data('src')
        return scrolled > e.offset().top ? (e.attr("src", src).removeClass('js-lazy'), false) : true
      })

      if (!images.length) {
        $w.off('.js-lazy')
      }

      clearTimeout(timer)
      timer = 0
    }

    $body.off('reset.js-lazy').on('reset.js-lazy', initLazyLoad)

    initLazyLoad()
  }

  initOnReadyAndPjax(pjax = false) {
    // Прилипшие заголовки таблиц
    $('.js-float-thead').floatThead({ zIndex: 999 })

    // Подсказки
    $('.tip').tooltip()

    this.autosizeTextareas()
    this.fotoramaInit(pjax)
  }

  onPjaxComplete() {
    $(document).on('pjax:complete', () => {
      this.pjax.onComplete()

      $(document.body).trigger('reset.js-lazy')

      this.initOnReadyAndPjax(true)
    })
  }

  onPjaxSend() {
    $(document).on('pjax:send', () => this.pjax.onSend())
  }
}

window.App = new Application

Vue.component('aviasales', require('./components/Aviasales.vue'))
Vue.component('youtube', require('./components/Youtube.vue'))

new Vue({
  el: '#pjax_container'
})
