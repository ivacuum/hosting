window.Vue = require('vue')
require('vue-resource')

Vue.http.interceptors.push((request, next) => {
  request.headers.set('X-CSRF-TOKEN', window['AppOptions'].csrfToken)

  next()
})

Vue.component('aviasales', require('./components/Aviasales.vue'))
Vue.component('images-uploader', require('./components/ImagesUploader.vue'))
Vue.component('rutracker-post', require('./components/RutrackerPost.vue'))
Vue.component('youtube', require('./components/Youtube.vue'))
