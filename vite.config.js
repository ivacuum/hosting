import {defineConfig} from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.js',
      'resources/js/hiragana-katakana.js',
      'resources/js/view-magnet-post.js',
      'node_modules/mousetrap/mousetrap.min.js',
      'node_modules/@github/details-menu-element/dist/index.js',
    ]),
  ],
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
})
