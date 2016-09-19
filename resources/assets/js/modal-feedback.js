const Feedback = (($) => {

  const NAME               = 'feedback'
  const DATA_KEY           = 'h.feedback'
  const EVENT_KEY          = `.${DATA_KEY}`
  const DATA_API_KEY       = '.data-api'
  const JQUERY_NO_CONFLICT = $.fn[NAME]

  const Default = {
    question : '',
    show     : true
  }

  const Event = {
    CLICK_DATA_API : `click${EVENT_KEY}${DATA_API_KEY}`
  }

  const Selector = {
    DATA_TOGGLE    : '[data-toggle="feedback"]',
    FORM           : 'form',
    QUESTION_INPUT : '.js-modal-question-input',
    QUESTION_TEXT  : '.js-modal-question-text'
  }

  class Feedback {

    constructor(el, config) {
      this._config = $.extend({}, Default, config)
      this._el     = el
      this._form   = $(el).find(Selector.FORM)[0]

      this._watchForFormSubmit()
    }

    static get Default() {
      return Default
    }

    show(relatedTarget) {
      this._fillQuestion(relatedTarget)
      $(this._el).modal('show', relatedTarget)
    }

    submit(e) {
      e.preventDefault()

      let data   = $(this._form).serialize()
      let method = this._form.getAttribute('method') || 'post'
      let url    = this._form.getAttribute('action')

      $.ajax({ url, method, data }).done((data) => {
        if (data.status === 'OK') {
          alert(data.message)
        } else {
          alert(data.message || 'Что-то пошло не так')
        }
      }).fail((jqxhr) => {
        alert(`${jqxhr.status} ${jqxhr.statusText}`)
      })

      $(this._el).modal('hide')
      this._form.reset()
    }

    toggle(relatedTarget) {
      this._fillQuestion(relatedTarget)
      $(this._el).modal('toggle', relatedTarget)
    }

    _watchForFormSubmit() {
      $(document).on('submit', this._form, (e) => this.submit(e))
    }

    _fillQuestion(relatedTarget) {
      const question = relatedTarget.getAttribute('data-question') || ''

      let $input = $(this._el).find(Selector.QUESTION_INPUT)
      let $text  = $(this._el).find(Selector.QUESTION_TEXT)

      $input.val(question)
      $text.text(question)

      if (question) {
        $text.show()
      } else {
        $text.hide()
      }
    }

    static _jQueryInterface(config, relatedTarget) {
      return this.each(function () {
        let data    = $(this).data(DATA_KEY)
        let _config = $.extend(
          {},
          Feedback.Default,
          $(this).data(),
          typeof config === 'object' && config
        )

        if (!data) {
          data = new Feedback(this, _config)
          $(this).data(DATA_KEY, data)
        }

        if (typeof config === 'string') {
          if (data[config] === undefined) {
            throw new Error(`No method named "${config}"`)
          }

          data[config](relatedTarget)
        } else if (_config.show) {
          data.show(relatedTarget)
        }
      })
    }

  }

  /**
   * Data Api
   */
  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (e) {
    let target
    let selector = this.getAttribute('data-target')

    if (selector) {
      target = $(selector)[0]
    }

    let config = $(target).data(DATA_KEY) ?
      'toggle' : $.extend({}, $(target).data(), $(this).data())

    if (this.tagName === 'A') {
      e.preventDefault()
    }

    Feedback._jQueryInterface.call($(target), config, this)
  })

  /**
   * jQuery
   */
  $.fn[NAME]             = Feedback._jQueryInterface
  $.fn[NAME].Constructor = Feedback
  $.fn[NAME].noConflict  = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT
    return Feedback._jQueryInterface
  }

  return Feedback

})(jQuery)

export default Feedback
