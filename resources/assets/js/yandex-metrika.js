export default class {
  constructor(id) {
    this.id = id
    this.metrika = null
    this.params = {}

    this.initCounter()
  }

  initCounter() {
    $(document).on(`yacounter${this.id}inited`, () => {
      this.metrika = window[`yaCounter${this.id}`]
      this.params = this.getParams()

      this.userParams(this.params)
      this.visitParams(this.params)
    })
  }

  getParams() {
    let params = {}

    if (window.matchMedia('(min-width: 1200px)').matches) {
      params.screen_width = '1200+'
    } else if (window.matchMedia('(min-width: 992px)').matches) {
      params.screen_width = '992+'
    } else if (window.matchMedia('(min-width: 768px)').matches) {
      params.screen_width = '768+'
    } else if (window.matchMedia('(min-width: 480px)').matches) {
      params.screen_width = '480+'
    } else {
      params.screen_width = '<480'
    }

    params.registered_user = window['AppOptions'].loggedIn

    return params
  }

  goal(name) {
    if (!this.metrika) {
      return
    }

    this.metrika.reachGoal(name)
  }

  pjaxHit() {
    if (!this.metrika) {
      return
    }

    this.metrika.hit(window.location.href, { params: { pjax: 1 }})
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
}
