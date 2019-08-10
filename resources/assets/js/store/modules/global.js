import * as types from '../mutation-types'

const stateObject = {
  guest: !window.AppOptions.loggedIn,
  isMobile: document.body.matches('.is-mobile'),
  breadcrumbs: [],
  validationErrors: {},
}

const actions = {}
const getters = {}

const mutations = {
  [types.BREADCRUMBS_SET](state, payload) {
    state.breadcrumbs = payload
  },

  [types.VALIDATION_ERRORS_CLEAR](state) {
    state.validationErrors = {}
  },

  [types.VALIDATION_ERRORS_SET](state, payload) {
    state.validationErrors = payload
  },
}

export default {
  state: stateObject,
  actions,
  getters,
  mutations,
}
