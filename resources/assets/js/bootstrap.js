import 'vac-gfe/js/laravel-axios'
import 'vac-gfe/js/laravel-echo'
import VueI18n from 'vue-i18n'

import AvatarUploader from './components/AvatarUploader.vue'
import Aviasales from './components/Aviasales.vue'
import BurnKanji from './components/BurnKanji.vue'
import BurnRadical from './components/BurnRadical.vue'
import BurnVocabulary from './components/BurnVocabulary.vue'
import Chat from './components/Chat.vue'
import GalleryUploader from './components/GalleryUploader.vue'
import HiraganaKatakana from './components/HiraganaKatakana.vue'
import ImagesUploader from './components/ImagesUploader.vue'
import Kanji from './components/Kanji.vue'
import Radicals from './components/Radicals.vue'
import RutrackerPost from './components/RutrackerPost.vue'
import TorrentTitle from './components/TorrentTitle.vue'
import Vocabulary from './components/Vocabulary.vue'
import WanikaniSearch from './components/WanikaniSearch.vue'
import Youtube from './components/Youtube.vue'

Vue.use(VueI18n)

Vue.component('avatar-uploader', AvatarUploader)
Vue.component('aviasales', Aviasales)
Vue.component('burn-kanji', BurnKanji)
Vue.component('burn-radical', BurnRadical)
Vue.component('burn-vocabulary', BurnVocabulary)
Vue.component('chat', Chat)
Vue.component('gallery-uploader', GalleryUploader)
Vue.component('hiragana-katakana', HiraganaKatakana)
Vue.component('images-uploader', ImagesUploader)
Vue.component('kanji', Kanji)
Vue.component('radicals', Radicals)
Vue.component('rutracker-post', RutrackerPost)
Vue.component('torrent-title', TorrentTitle)
Vue.component('vocabulary', Vocabulary)
Vue.component('wanikani-search', WanikaniSearch)
Vue.component('youtube', Youtube)
