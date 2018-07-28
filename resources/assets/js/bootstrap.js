/* global notie */

import 'vac-gfe/js/laravel-axios'
import 'vac-gfe/js/laravel-echo'

import FeedbackForm from './components/FeedbackForm.vue'
import Youtube from './components/Youtube.vue'

import decimal from './decimal'

Vue.filter('decimal', decimal)

Vue.component('avatar-uploader', () => import(/* webpackChunkName: "my" */'./components/AvatarUploader.vue'))
Vue.component('burn-kanji', () => import(/* webpackChunkName: "japanese" */'./components/BurnKanji.vue'))
Vue.component('burn-radical', () => import(/* webpackChunkName: "japanese" */'./components/BurnRadical.vue'))
Vue.component('burn-vocabulary', () => import(/* webpackChunkName: "japanese" */'./components/BurnVocabulary.vue'))
Vue.component('chat', () => import(/* webpackChunkName: "magnets" */'./components/Chat.vue'))
Vue.component('feedback-form', FeedbackForm)
Vue.component('gallery-uploader', () => import(/* webpackChunkName: "gallery" */'./components/GalleryUploader.vue'))
Vue.component('hiragana-katakana', () => import(/* webpackChunkName: "japanese" */'./components/HiraganaKatakana.vue'))
Vue.component('images-uploader', () => import(/* webpackChunkName: "acp" */'./components/ImagesUploader.vue'))
Vue.component('kanji', () => import(/* webpackChunkName: "japanese" */'./components/Kanji.vue'))
Vue.component('radicals', () => import(/* webpackChunkName: "japanese" */'./components/Radicals.vue'))
Vue.component('rutracker-post', () => import(/* webpackChunkName: "magnets" */'./components/RutrackerPost.vue'))
Vue.component('torrent-title', () => import(/* webpackChunkName: "magnets" */'./components/TorrentTitle.vue'))
Vue.component('vocabulary', () => import(/* webpackChunkName: "japanese" */'./components/Vocabulary.vue'))
Vue.component('wanikani-search', () => import(/* webpackChunkName: "japanese" */'./components/WanikaniSearch.vue'))
Vue.component('youtube', Youtube)

notie.setOptions({ overlayOpacity: 1 })
