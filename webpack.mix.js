const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/assets').vue()
  .sass('resources/sass/app.scss', 'public/assets')
  .postCss('resources/css/tailwind.pcss', 'public/assets', [
    require('postcss-import'),
    require('autoprefixer'),
    require('tailwindcss'),
  ])

  .copy('resources/js/pwa/service-worker.js', 'public/assets')
  .copy('resources/js/pwa/service-worker-installer.js', 'public/assets')

  .copy('node_modules/mousetrap/mousetrap.min.js', 'public/assets/mousetrap.js')

  .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/jquery.js')
  .copy('node_modules/jquery.scrollto/jquery.scrollTo.min.js', 'public/assets/jquery.scrollto.js')

  .copy('node_modules/autosize/dist/autosize.min.js', 'public/assets/autosize.js')

  .copy('node_modules/notie/dist/notie.min.js', 'public/assets/notie.js')

  .copy('node_modules/vue/dist/vue.min.js', 'public/assets/vue.js')
  .copy('node_modules/vue-i18n/dist/vue-i18n.min.js', 'public/assets/vue-i18n.js')

  .copy('node_modules/axios/dist/axios.min.js', 'public/assets/axios.js')
  .copy('resources/js/empty.map', 'public/assets/axios.min.map')

  .copy('node_modules/livewire-vue/dist/livewire-vue.js', 'public/assets')
  .copy('resources/js/empty.map', 'public/assets/livewire-vue.js.map')

  .combine(['node_modules/@github/details-menu-element/dist/index.js'], 'public/assets/details-menu-element.js')

  .sourceMaps(false, false)
  .version()
  .disableNotifications()

  .options({
    processCssUrls: false,
  })

  .webpackConfig(require('./webpack.config'))
