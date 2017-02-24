let mix = require('laravel-mix')

// combine минифицируются, copy копируются как есть

// Зачем combine у некоторых пакетов:
// - axios минифицируется, чтобы убрать ссылку на sourcemap
// - jquery.pjax для уменьшения размера
// - fotorama для применения собственных настроек

mix.js('resources/assets/js/app.js', 'public/assets')
  /*
  .extract(['vue'], 'public/build/vue.js')
  .extract(['autosize'], 'public/build/autosize.js')
  .extract(['axios'], 'public/build/axios.js')
  .extract(['bootstrap-sass'], 'public/build/bootstrap.js')
  .extract(['jquery', 'jquery.scrollto'], 'public/build/jquery.js')
  .extract(['lodash/throttle'], 'public/build/throttle.js')
  .extract(['promise-polyfill'], 'public/build/polyfills.js')
  */

  .sass('resources/assets/sass/app.scss', 'public/assets')

  .copy('node_modules/promise-polyfill/promise.min.js', 'public/assets/polyfills.js')

  .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/jquery.js')
  .combine(['resources/assets/js/jquery-pjax.js'], 'public/assets/jquery.pjax.js')
  .copy('node_modules/jquery.scrollto/jquery.scrollTo.min.js', 'public/assets/jquery.scrollto.js')

  .copy('node_modules/autosize/dist/autosize.min.js', 'public/assets/autosize.js')

  .copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/assets/bootstrap.js')

  .copy('node_modules/vue/dist/vue.min.js', 'public/assets/vue.js')

  .combine(['node_modules/axios/dist/axios.min.js'], 'public/assets/axios.js')

  .copy('node_modules/fotorama/fotorama.css', 'public/assets/fotorama.css')
  .copy('node_modules/fotorama/fotorama.png', 'public/assets/fotorama.png')
  .copy('node_modules/fotorama/fotorama@2x.png', 'public/assets/fotorama@2x.png')

  .combine([
    'resources/assets/js/fotorama.js',
    'node_modules/fotorama/fotorama.js'
  ], 'public/assets/fotorama.js')

  // .copy('node_modules/fotorama', 'public/build/fotorama-4.6.4/fotorama')

  .autoload({})
  .version()
  .disableNotifications()
