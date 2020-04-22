import global from './modules/global'

export default new Vuex.Store({
  modules: {
    global,
  },

  strict: process.env.NODE_ENV !== 'production',
})
