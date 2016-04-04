import Pjax from './pjax';

import './events';
import './shortcuts';
import './yandex-dns';

class Application {
  constructor() {
    this.pjax = new Pjax();

    this.ajaxProgress();
    this.csrfToken();
    this.onPjaxComplete();
    this.onPjaxSend();

    $(document).ready(() => {
      this.lazyLoadImages();
      this.initOnReadyAndPjax();
    });
  }

  ajaxProgress() {
    $(document).ajaxStart(() => NProgress.start());
    $(document).ajaxStop(() => NProgress.done());
  }

  csrfToken() {
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  }

  lazyLoadImages() {
    const offset = 300;
    const breakpoint = 1200;

    let $w = $(window),
        $body = $(document.body),
        images,
        timer;

    const width = $w.width();

    function initLazyLoad() {
      images = $('.js-lazy');

      $w.off('.js-lazy').on('scroll.js-lazy resize.js-lazy', () => timer || (timer = setTimeout(performLazyLoad, 250)));

      performLazyLoad();
    }

    function performLazyLoad() {
      const scrolled = $w.scrollTop() + $w.height() + offset;

      images = images.filter(function() {
        let e = $(this);
        const src = width > breakpoint ? (e.data('src-2x') || e.data('src')) : e.data('src');
        return scrolled > e.offset().top ? (e.attr("src", src).removeClass('js-lazy'), false) : true;
      });

      if (!images.length) {
        $w.off('.js-lazy');
      }

      clearTimeout(timer);
      timer = 0;
    }

    $body.off('reset.js-lazy').on('reset.js-lazy', initLazyLoad);

    initLazyLoad();
  }

  initOnReadyAndPjax() {
    // Прилипшие заголовки таблиц
    $('.js-float-thead').floatThead();

    // Подсказки
    $('.tip').tooltip();
  }

  onPjaxComplete() {
    $(document).on('pjax:complete', () => {
      this.pjax.onComplete();
      $('.fotorama').fotorama();

      $(document.body).trigger('reset.js-lazy');

      this.initOnReadyAndPjax();
    });
  }

  onPjaxSend() {
    $(document).on('pjax:send', () => this.pjax.onSend());
  }
}

window.App = new Application;
