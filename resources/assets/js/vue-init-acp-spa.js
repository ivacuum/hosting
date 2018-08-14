import svg from './svg-icons'
import store from './store/store'
import router from './router-acp'
import AcpApp from './components/acp/AcpApp.vue'

/**
 * @namespace window.i18nData
 */
export default function initVueAcpSpa(selector, locale = 'ru') {
  if (document.querySelector(selector)) {
    return new Vue({
      el: selector,
      i18n: new VueI18n({
        locale,
        messages: window.i18nData,
        silentTranslationWarn: true,
      }),
      store,
      render: h => h(AcpApp),
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
