export default function initVueComponents(selector, locale = 'ru') {
  if (window.Vue === undefined) {
    return null
  }

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
