let mix = require('laravel-mix')

mix.js('resources/assets/js/app.js', 'public/assets')
  .sass('resources/assets/sass/app.scss', 'public/assets')

  .copy('resources/assets/js/pwa/service-worker.js', 'public/assets')
  .copy('resources/assets/js/pwa/service-worker-installer.js', 'public/assets')

  .copy('node_modules/promise-polyfill/promise.min.js', 'public/assets/polyfills.js')

  .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/jquery.js')
  .copy('node_modules/vac-gfe/vendor/jquery.pjax.js', 'public/assets/jquery.pjax.js')
  .copy('node_modules/jquery.scrollto/jquery.scrollTo.min.js', 'public/assets/jquery.scrollto.js')

  .copy('node_modules/autosize/dist/autosize.min.js', 'public/assets/autosize.js')

  .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/assets/bootstrap.js')
  .copy('node_modules/vac-gfe/js/empty.map', 'public/assets/bootstrap.min.js.map')

  .copy('node_modules/vue/dist/vue.min.js', 'public/assets/vue.js')

  .copy('node_modules/axios/dist/axios.min.js', 'public/assets/axios.js')
  .copy('node_modules/vac-gfe/js/empty.map', 'public/assets/axios.min.map')

  .copy('resources/assets/js/fotorama.js', 'public/assets/fotorama/settings.js')
  .copyDirectory('node_modules/fotorama', 'public/assets/fotorama')

  .copy('node_modules/socket.io-client/dist/socket.io.js', 'public/assets/socket.io.js')
  .copy('node_modules/vac-gfe/js/empty.map', 'public/assets/socket.io.js.map')

  .copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/assets/popper.js')
  .copy('node_modules/vac-gfe/js/empty.map', 'public/assets/popper.min.js.map')

  .sourceMaps(false, false)
  .version()
  .disableNotifications()

  .options({
    processCssUrls: false
  })
