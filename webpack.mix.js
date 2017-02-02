const { mix } = require('laravel-mix')

mix.js('resources/assets/js/app.js', 'public/build')
  .extract(['vue'], 'public/build/vue.js')
  .extract(['autosize'], 'public/build/autosize.js')
  .extract(['axios'], 'public/build/axios.js')
  .extract(['bootstrap-sass'], 'public/build/bootstrap.js')
  .extract(['floatthead'], 'public/build/floatthead.js')
  .extract(['jquery', 'jquery.scrollto'], 'public/build/jquery.js')
  .extract(['lodash.throttle'], 'public/build/throttle.js')
  .extract(['promise-polyfill'], 'public/build/polyfills.js')

  .sass('resources/assets/sass/app.scss', 'public/build')
  .sass('resources/assets/sass/fotorama.scss', 'public/build')

  // .copy('node_modules/fotorama', 'public/build/fotorama-4.6.4/fotorama')

  .version()
  .disableNotifications()

