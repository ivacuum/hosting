/* global Vuex */

export default new Vuex.Store({
  state: {
    breadcrumbs: [],
    validationErrors: {},
  },

  mutations: {
    clearValidationErrors(state) {
      state.validationErrors = {}
    },

    setBreadcrumbs(state, payload) {
      state.breadcrumbs = payload
    },

    setValidationErrors(state, payload) {
      state.validationErrors = payload
    },
  },
})
