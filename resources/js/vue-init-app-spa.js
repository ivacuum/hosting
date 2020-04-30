import App from './components/App.vue'
import svg from './svg-icons'
import store from './store/store'
import router from './router'
import '../sass/empty.scss' // Иначе в laravel-mix 4 не загружаются стили из компонентов vue

/**
 * @namespace window.i18nData
 */
export default function initVueAppSpa(selector, locale = 'ru') {
  if (document.querySelector(selector)) {
    return new Vue({
      el: selector,
      i18n: new VueI18n({
        locale,
        messages: window.i18nData,
        silentTranslationWarn: true,
      }),
      store,
      render: (h) => h(App),
      router,

      data() {
        return {
          svg,
        }
      },
    })
  }

  return null
}
