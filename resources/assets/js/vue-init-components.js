/* global VueI18n */
export default function initVueComponents(selector, locale = 'ru') {
  if (document.querySelector(selector)) {
    return new Vue({
      el: selector,
      i18n: new VueI18n({
        locale,
      }),
    })
  }

  return null
}
