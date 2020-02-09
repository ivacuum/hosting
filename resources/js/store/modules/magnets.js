import * as types from '../mutation-types'
import locale from '../../i18n/locale'

const stateObject = {
  page: {
    data: [],
    meta: {},
    links: {},
  },
  loaded: false,
  resource: {},
  categoryList: window.AppData && window.AppData.categoryList ? window.AppData.categoryList : {},
  categoryTree: window.AppData && window.AppData.categoryTree ? window.AppData.categoryTree : {},
  categoryStats: window.AppData && window.AppData.categoryStats ? window.AppData.categoryStats : [],
}

const actions = {
  clickMagnet({ commit }, magnet) {
    if (magnet.clicked) return

    commit(types.MAGNET_CLICK, magnet)

    // axios.post(`${locale}/torrents/${magnet.id}/magnet`)
  },

  fetchMagnet({ commit }, id) {
    return axios
      .get(`${locale}/magnets/${id}`)
      .then((response) => {
        commit(types.MAGNET_SET, response.data.data)
      })
  },

  fetchMagnets({ commit }, { fullPath }) {
    return axios
      .get(fullPath.replace('/magnets', '/torrents'))
      .then((response) => {
        // console.log('fetchMagnets()', performance.now())
        commit(types.MAGNETS_SET, response.data)
      })
  },

  unsetMagnet({ commit }) {
    commit(types.MAGNET_UNSET)
  },
}

const getters = {}

const mutations = {
  [types.MAGNET_CLICK](state, magnet) {
    magnet.clicks += 1
    magnet.clicked = true
    console.log('magnet.clicks', magnet.clicks)
  },

  [types.MAGNET_SET](state, data) {
    state.resource = data
  },

  [types.MAGNET_UNSET](state) {
    state.resource = {}
  },

  [types.MAGNETS_SET](state, data) {
    state.page = data
    state.loaded = true
  },
}

export default {
  state: stateObject,
  actions,
  getters,
  mutations,
}
