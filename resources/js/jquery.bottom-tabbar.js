import throttle from 'lodash/throttle'

if (window.matchMedia('(max-width: 768px)').matches && document.querySelector('.bottom-tabbar-container')) {
  let lastOffset = window.scrollY
  const tabBar = document.querySelector('.bottom-tabbar-container')
  const tabBarHeight = tabBar.offsetHeight
  const threshold = 77

  $(window).on('scroll.js-bottom-tabbar-reveal', throttle(() => {
    const offset = window.scrollY
    const windowHeight = window.innerHeight
    const docHeight = document.body.clientHeight

    // Домотали до конца
    if (offset + windowHeight >= docHeight - tabBarHeight) {
      tabBar.classList.add('revealed')
      lastOffset = offset
      return
    }

    // Промотали мало
    if (Math.abs(lastOffset - offset) <= threshold) {
      return
    }

    if (offset > lastOffset) {
      // Промотали вниз достаточно для скрытия
      tabBar.classList.remove('revealed')
    } else {
      // Промотали вверх достаточно для показа
      tabBar.classList.add('revealed')
    }

    lastOffset = offset
  }, 250))
}
