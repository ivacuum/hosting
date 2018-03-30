import 'vac-gfe/js/laravel-axios'
import 'vac-gfe/js/laravel-echo'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

Vue.component('avatar-uploader', require('./components/AvatarUploader.vue'))
Vue.component('aviasales', require('./components/Aviasales.vue'))
Vue.component('burn-kanji', require('./components/BurnKanji.vue'))
Vue.component('burn-radical', require('./components/BurnRadical.vue'))
Vue.component('burn-vocabulary', require('./components/BurnVocabulary.vue'))
Vue.component('chat', require('./components/Chat.vue'))
Vue.component('gallery-uploader', require('./components/GalleryUploader.vue'))
Vue.component('hiragana-katakana', require('./components/HiraganaKatakana.vue'))
Vue.component('images-uploader', require('./components/ImagesUploader.vue'))
Vue.component('kanji', require('./components/Kanji.vue'))
Vue.component('radicals', require('./components/Radicals.vue'))
Vue.component('rutracker-post', require('./components/RutrackerPost.vue'))
Vue.component('torrent-title', require('./components/TorrentTitle.vue'))
Vue.component('vocabulary', require('./components/Vocabulary.vue'))
Vue.component('wanikani-search', require('./components/WanikaniSearch.vue'))
Vue.component('youtube', require('./components/Youtube.vue'))
