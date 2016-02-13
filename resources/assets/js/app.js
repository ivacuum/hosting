import Pjax from './pjax';

import './events';
import './shortcuts';
import './yandex-dns';

class Application {
  constructor() {
    this.blazy_options = {
      selector: '.js-lazy',
      offset: 300,
      successClass: 'img-loaded',
      breakpoints: [{
        width: 1200,
        src: 'data-src-2x'
      }]
    };
    this.pjax = new Pjax();

    this.ajaxProgress();
    this.csrfToken();
    this.onPjaxComplete();
    this.onPjaxSend();

    $(document).ready(() => this.initOnReadyAndPjax());
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
    return new Blazy(this.blazy_options);
  }

  initOnReadyAndPjax() {
    // Прилипшие заголовки таблиц
    $('.js-float-thead').floatThead();

    // Подсказки
    $('.tip').tooltip();

    this.lazyLoadImages();
  }

  onPjaxComplete() {
    $(document).on('pjax:complete', () => {
      this.pjax.onComplete();
      $('.fotorama').fotorama();

      this.initOnReadyAndPjax();
    });
  }

  onPjaxSend() {
    $(document).on('pjax:send', () => this.pjax.onSend());
  }
}

window.App = new Application;
