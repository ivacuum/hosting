export default class {
  constructor(id) {
    this.id = id
    this.metrika = null
    this.params = {}

    this.initCounter()
  }

  initCounter() {
    document.addEventListener(`yacounter${this.id}inited`, () => {
      this.metrika = window[`yaCounter${this.id}`]
      this.params = this.getParams()

      this.userParams(this.params)
      this.visitParams(this.params)
    })
  }

  getParams() {
    const params = {}

    if (window.matchMedia('(min-width: 1200px)').matches) {
      params.screen_width = '1200+' // xl
    } else if (window.matchMedia('(min-width: 992px)').matches) {
      params.screen_width = '992+' // lg
    } else if (window.matchMedia('(min-width: 768px)').matches) {
      params.screen_width = '768+' // md
    } else if (window.matchMedia('(min-width: 576px)').matches) {
      params.screen_width = '576+' // sm
    } else if (window.matchMedia('(min-width: 480px)').matches) {
      params.screen_width = '480+'
    } else {
      params.screen_width = '<480'
    }

    params.registered_user = window.AppOptions.loggedIn

    return params
  }

  userParams(params) {
    if (!this.metrika) {
      return
    }

    this.metrika.userParams(params)
  }

  visitParams(params) {
    if (!this.metrika) {
      return
    }

    this.metrika.params(params)
  }

  vueHit(url = null) {
    if (!this.metrika) return

    this.metrika.hit(url || window.location.href, { params: { vue: 1 } })
  }
}
