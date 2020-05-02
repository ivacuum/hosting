import './laravel-axios'

import AvatarUploader from './components/AvatarUploader'
import ImagesUploader from './components/ImagesUploader'
import Youtube from './components/Youtube.vue'
import FeedbackForm from './components/FeedbackForm.vue'

Vue.config.productionTip = false

Vue.component('avatar-uploader', AvatarUploader)
Vue.component('feedback-form', FeedbackForm)
Vue.component('gallery-uploader', () => import(/* webpackChunkName: "gallery" */'./components/GalleryUploader.vue'))
Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/japanese/HiraganaKatakana.vue'))
Vue.component('images-uploader', ImagesUploader)
Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))
Vue.component('torrent-title', () => import(/* webpackChunkName: "magnets" */'./components/TorrentTitle.vue'))
Vue.component('youtube', Youtube)

notie.setOptions({ overlayOpacity: 1 })
