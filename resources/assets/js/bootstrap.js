import './polyfills'

window.$ = window.jQuery = require('jquery')
window.autosize = require('autosize')

require('jquery.scrollto')
require('bootstrap-sass')

window.axios = require('axios')

window.axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
  'X-Requested-With': 'XMLHttpRequest'
}

import './fotorama'
import './jquery-pjax'
