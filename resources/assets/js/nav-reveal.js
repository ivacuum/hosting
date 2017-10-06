let throttle = require('lodash/throttle')

if (window.matchMedia('(max-width: 768px)').matches) {
  let last_offset = window.pageYOffset
  let $tabbar = $('.bottom-tabbar-container')
  const tabbar_height = $tabbar.height()
  const threshold = 77

  $(window).on('scroll.js-nav-reveal', throttle(function () {
    let offset = window.pageYOffset
    const window_height = window.innerHeight
    const doc_height = $(document).height()

    // Домотали до конца
    if (offset + window_height >= doc_height - tabbar_height) {
      $tabbar.addClass('revealed')
      last_offset = offset
      return
    }

    // Промотали мало
    if (Math.abs(last_offset - offset) <= threshold) {
      return
    }

    if (offset > last_offset) {
      // Промотали вниз достаточно для скрытия
      $tabbar.removeClass('revealed')
    } else {
      // Промотали вверх достаточно для показа
      $tabbar.addClass('revealed')
    }

    last_offset = offset
  }, 250))
}
