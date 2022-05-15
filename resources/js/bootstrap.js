import './laravel-axios'

if (window.Vue) {
  Vue.config.productionTip = false

  Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/japanese/HiraganaKatakana.vue'))
  Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))
}

notie.setOptions({ overlayOpacity: 1 })
