import 'vac-gfe/js/laravel-axios'
import 'vac-gfe/js/laravel-echo'

import FeedbackForm from './components/FeedbackForm.vue'
import Youtube from './components/Youtube.vue'

import decimal from './decimal'

Vue.config.productionTip = false

Vue.filter('decimal', decimal)

// TODO: delete magnets
Vue.component('avatar-uploader', () => import(/* webpackChunkName: "my" */'./components/AvatarUploader.vue'))
Vue.component('chat', () => import(/* webpackChunkName: "magnets" */'./components/Chat.vue'))
Vue.component('feedback-form', FeedbackForm)
Vue.component('gallery-uploader', () => import(/* webpackChunkName: "gallery" */'./components/GalleryUploader.vue'))
Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/japanese/HiraganaKatakana.vue'))
Vue.component('images-uploader', () => import(/* webpackChunkName: "acp" */'./components/ImagesUploader.vue'))
Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))
Vue.component('torrent-title', () => import(/* webpackChunkName: "magnets" */'./components/TorrentTitle.vue'))
Vue.component('youtube', Youtube)

notie.setOptions({ overlayOpacity: 1 })
