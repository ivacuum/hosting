import global from './modules/global'
import magnets from './modules/magnets'

export default new Vuex.Store({
  modules: {
    global,
    magnets,
  },

  strict: process.env.NODE_ENV !== 'production',
})
