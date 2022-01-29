import './laravel-axios'
import ImagesUploader from './components/ImagesUploader.vue'
import FeedbackForm from './components/FeedbackForm.vue'

if (window.Vue) {
  Vue.config.productionTip = false

  Vue.component('feedback-form', FeedbackForm)
  Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/japanese/HiraganaKatakana.vue'))
  Vue.component('images-uploader', ImagesUploader)
  Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))
}

notie.setOptions({overlayOpacity: 1})
