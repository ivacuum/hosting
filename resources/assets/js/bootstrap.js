window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window['AppOptions'].csrfToken
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

Vue.component('avatar-uploader', require('./components/AvatarUploader.vue'))
Vue.component('aviasales', require('./components/Aviasales.vue'))
Vue.component('gallery-uploader', require('./components/GalleryUploader.vue'))
Vue.component('images-uploader', require('./components/ImagesUploader.vue'))
Vue.component('rutracker-post', require('./components/RutrackerPost.vue'))
Vue.component('torrent-title', require('./components/TorrentTitle.vue'))
Vue.component('youtube', require('./components/Youtube.vue'))

import Echo from 'laravel-echo'

if (typeof io !== 'undefined') {
  window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window['AppOptions'].socketIoHost,
    csrfToken: window['AppOptions'].csrfToken
  })
}
