const NEXT_PAGE_SELECTOR = '#next_page'
const PREV_PAGE_SELECTOR = '#previous_page'
const SCROLL_ANIMATION_SPEED = 0

Mousetrap.bind(['ctrl+left', 'alt+left'], () => {
  $(document).trigger('shortcuts.to_prev_page')
})

Mousetrap.bind(['ctrl+right', 'alt+right'], () => {
  $(document).trigger('shortcuts.to_next_page')
})

// Русские буквы
Mousetrap.addKeycodes({
  1088: 'h', // р
  1076: 'j', // о
  1086: 'k', // л
  1083: 'l', // д
})

Mousetrap.bind('h', () => {
  $(document).trigger('shortcuts.to_first_post')
})

Mousetrap.bind('j', () => {
  $(document).trigger('shortcuts.to_next_post')
})

Mousetrap.bind('k', () => {
  $(document).trigger('shortcuts.to_prev_post')
})

Mousetrap.bind('l', () => {
  $(document).trigger('shortcuts.to_last_post')
})

Mousetrap.bind('/', () => {
  const search = document.querySelector('.js-search-input')

  if (search !== null) {
    search.focus()
  }
}, 'keyup')

$(document).on('shortcuts.redirect', (e, selector) => {
  const link = document.querySelector(selector)

  if (!link) return false

  const url = link.getAttribute('href')

  if (!url) return false

  if (link.classList.contains('js-pjax')) {
    $.pjax({ url, container: '#pjax_container' })
  } else {
    document.location.href = url
  }

  return true
})

$(document).on('shortcuts.to_next_page', () => {
  $(document).trigger('shortcuts.redirect', [NEXT_PAGE_SELECTOR])
})

$(document).on('shortcuts.to_prev_page', () => {
  $(document).trigger('shortcuts.redirect', [PREV_PAGE_SELECTOR])
})

$(document).on('shortcuts.to_first_post', () => {
  const firstItem = document.querySelector('.js-shortcuts-item')

  if (firstItem === null) return false

  if (firstItem.classList.contains('focus')) {
    $(document).trigger('shortcuts.to_prev_page')
  } else {
    const focusedItem = document.querySelector('.js-shortcuts-item.focus')

    if (focusedItem !== null) {
      focusedItem.classList.remove('focus')
    }

    firstItem.classList.add('focus')

    $.scrollTo(firstItem, SCROLL_ANIMATION_SPEED, {
      axis: 'y',
    })
  }

  return true
})

$(document).on('shortcuts.to_last_post', () => {
  const items = [...document.querySelectorAll('.js-shortcuts-item')]

  if (items.length === 0) return false

  const lastItem = items[items.length - 1]

  if (lastItem.classList.contains('focus')) {
    $(document).trigger('shortcuts.to_next_page')
  } else {
    const focusedItem = document.querySelector('.js-shortcuts-item.focus')

    if (focusedItem !== null) {
      focusedItem.classList.remove('focus')
    }

    lastItem.classList.add('focus')

    $.scrollTo(lastItem, SCROLL_ANIMATION_SPEED, {
      axis: 'y',
    })
  }

  return true
})

$(document).on('shortcuts.to_next_post', () => {
  const firstItem = document.querySelector('.js-shortcuts-item')

  if (firstItem === null) return false

  const focusedItem = document.querySelector('.js-shortcuts-item.focus')

  if (focusedItem === null) {
    firstItem.classList.add('focus')

    $.scrollTo(firstItem, SCROLL_ANIMATION_SPEED, {
      axis: 'y',
    })
  } else {
    const items = [...document.querySelectorAll('.js-shortcuts-item')]
    let nextItem = null

    items.some((item, i) => {
      if (item.classList.contains('focus')) {
        nextItem = items.length > i + 1 ? items[i + 1] : null
        return true
      }

      return false
    })

    if (nextItem === null) {
      $(document).trigger('shortcuts.to_next_page')
    } else {
      focusedItem.classList.remove('focus')
      nextItem.classList.add('focus')

      $.scrollTo(nextItem, SCROLL_ANIMATION_SPEED, {
        axis: 'y',
      })
    }
  }

  return true
})

$(document).on('shortcuts.to_prev_post', () => {
  const items = [...document.querySelectorAll('.js-shortcuts-item')]

  if (items.length === 0) return false

  const lastItem = items[items.length - 1]
  const focusedItem = document.querySelector('.js-shortcuts-item.focus')

  if (focusedItem === null) {
    lastItem.classList.add('focus')

    $.scrollTo(lastItem, SCROLL_ANIMATION_SPEED, {
      axis: 'y',
    })
  } else {
    let prevItem = null

    items.some((item, i) => {
      if (item.classList.contains('focus')) {
        prevItem = i > 0 ? items[i - 1] : null
        return true
      }

      return false
    })

    if (prevItem === null) {
      $(document).trigger('shortcuts.to_prev_page')
    } else {
      focusedItem.classList.remove('focus')
      prevItem.classList.add('focus')

      $.scrollTo(prevItem, SCROLL_ANIMATION_SPEED, {
        axis: 'y',
      })
    }
  }

  return true
})
