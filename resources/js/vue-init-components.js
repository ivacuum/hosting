export default function initVueComponents(selector, locale = 'ru') {
  if (window.Vue === undefined) {
    return null
  }

  if (document.querySelector(selector)) {
    Vue.config.productionTip = false

    Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/japanese/HiraganaKatakana.vue'))
    Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))

    return new Vue({
      el: selector,
      i18n: new VueI18n({
        locale,
      }),
    })
  }

  return null
}
