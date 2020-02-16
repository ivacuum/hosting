import throttle from 'lodash/throttle'

if (window.matchMedia('(max-width: 768px)').matches) {
  let lastOffset = window.pageYOffset
  const $tabbar = $('.bottom-tabbar-container')
  const tabbarHeight = $tabbar.height()
  const threshold = 77

  $(window).on('scroll.js-bottom-tabbar-reveal', throttle(() => {
    const offset = window.pageYOffset
    const windowHeight = window.innerHeight
    const docHeight = $(document).height()

    // Домотали до конца
    if (offset + windowHeight >= docHeight - tabbarHeight) {
      $tabbar.addClass('revealed')
      lastOffset = offset
      return
    }

    // Промотали мало
    if (Math.abs(lastOffset - offset) <= threshold) {
      return
    }

    if (offset > lastOffset) {
      // Промотали вниз достаточно для скрытия
      $tabbar.removeClass('revealed')
    } else {
      // Промотали вверх достаточно для показа
      $tabbar.addClass('revealed')
    }

    lastOffset = offset
  }, 250))
}
