export default class {
  constructor({ container = '#pjax_container', selector = '.js-pjax', timeout = 5000 } = {}) {
    this.container = container
    this.selector = selector
    this.timeout = timeout

    this.setup()
  }

  onComplete() {
    $(this.container).css('opacity', 1)
  }

  onSend() {
    $(this.container).css('opacity', 0.5)
  }

  setup() {
    if ($.support.pjax) {
      $.pjax.defaults.timeout = this.timeout
    }

    $(document).pjax(this.selector, this.container)
  }
}
