export default class {
  constructor({
    container = '#pjax_container',
    selector = '.js-pjax',
    timeout = 5000,
  } = {}) {
    this.container = container
    this.selector = selector
    this.timeout = timeout

    this.setup()
  }

  onComplete() {
    $('.js-curtain')
      .removeClass('curtain-opened')
      .addClass('curtain-closed')
  }

  onSend(e) {
    if (!$(e.relatedTarget).hasClass('js-pjax-no-dim')) {
      $('.js-curtain')
        .removeClass('curtain-closed')
        .addClass('curtain-opened')
    }
  }

  setup() {
    if ($.support.pjax) {
      $.pjax.defaults.timeout = this.timeout
      $.pjax.defaults.maxCacheLength = 0
    }

    $(document).pjax(this.selector, this.container)
  }
}
