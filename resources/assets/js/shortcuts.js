/* global $, Mousetrap */

const NEXT_PAGE_SELECTOR = '#next_page'
const PREV_PAGE_SELECTOR = '#previous_page'
const SCROLL_ANIMATION_SPEED = 0

Mousetrap.bind(['ctrl+left', 'alt+left'], function () {
  $(document).trigger('shortcuts.to_prev_page')
})

Mousetrap.bind(['ctrl+right', 'alt+right'], function () {
  $(document).trigger('shortcuts.to_next_page')
})

// Русские буквы
Mousetrap.addKeycodes({
  1088: 'h', // р
  1076: 'j', // о
  1086: 'k', // л
  1083: 'l', // д
})

Mousetrap.bind('h', function () {
  $(document).trigger('shortcuts.to_first_post')
})

Mousetrap.bind('j', function () {
  $(document).trigger('shortcuts.to_next_post')
})

Mousetrap.bind('k', function () {
  $(document).trigger('shortcuts.to_prev_post')
})

Mousetrap.bind('l', function () {
  $(document).trigger('shortcuts.to_last_post')
})

Mousetrap.bind('/', function () {
  let search = document.querySelector('.js-search-input')

  if (search !== null) {
    search.focus()
  }
}, 'keyup')

$(document).on('shortcuts.redirect', function (e, selector) {
  let link = document.querySelector(selector)

  if (!link) {
    return false
  }

  let url = link.getAttribute('href')

  if (!url) {
    return false
  }

  if (link.classList.contains('js-pjax')) {
    $.pjax({ url, container: '#pjax_container' })
  } else {
    document.location.href = url
  }
})

$(document).on('shortcuts.to_next_page', function () {
  $(document).trigger('shortcuts.redirect', [NEXT_PAGE_SELECTOR])
})

$(document).on('shortcuts.to_prev_page', function () {
  $(document).trigger('shortcuts.redirect', [PREV_PAGE_SELECTOR])
})

$(document).on('shortcuts.to_first_post', function () {
  let first_item = document.querySelector('.js-shortcuts-item')

  if (first_item === null) {
    return false
  }

  if (first_item.classList.contains('focus')) {
    $(document).trigger('shortcuts.to_prev_page')
  } else {
    let focused_item = document.querySelector('.js-shortcuts-item.focus')

    if (focused_item !== null) {
      focused_item.classList.remove('focus')
    }

    first_item.classList.add('focus')

    $.scrollTo(first_item, SCROLL_ANIMATION_SPEED, {
      axis: 'y'
    })
  }
})

$(document).on('shortcuts.to_last_post', function () {
  let items = document.querySelectorAll('.js-shortcuts-item')

  if (items.length === 0) {
    return false
  }

  let last_item = items[items.length - 1]

  if (last_item.classList.contains('focus')) {
    $(document).trigger('shortcuts.to_next_page')
  } else {
    let focused_item = document.querySelector('.js-shortcuts-item.focus')

    if (focused_item !== null) {
      focused_item.classList.remove('focus')
    }

    last_item.classList.add('focus')

    $.scrollTo(last_item, SCROLL_ANIMATION_SPEED, {
      axis: 'y'
    })
  }
})

$(document).on('shortcuts.to_next_post', function () {
  let first_item = document.querySelector('.js-shortcuts-item')

  if (first_item === null) {
    return false
  }

  let focused_item = document.querySelector('.js-shortcuts-item.focus')

  if (focused_item === null) {
    first_item.classList.add('focus')

    $.scrollTo(first_item, SCROLL_ANIMATION_SPEED, {
      axis: 'y'
    })
  } else {
    let items = document.querySelectorAll('.js-shortcuts-item')
    let next_item

    for (let [i, item] of items.entries()) {
      if (item.classList.contains('focus')) {
        next_item = items.length > i + 1 ? items[i + 1] : null
        break
      }
    }

    if (next_item === null) {
      $(document).trigger('shortcuts.to_next_page')
    } else {
      focused_item.classList.remove('focus')
      next_item.classList.add('focus')

      $.scrollTo(next_item, SCROLL_ANIMATION_SPEED, {
        axis: 'y'
      })
    }
  }
})

$(document).on('shortcuts.to_prev_post', function () {
  let items = document.querySelectorAll('.js-shortcuts-item')

  if (items.length === 0) {
    return false
  }

  let last_item = items[items.length - 1]
  let focused_item = document.querySelector('.js-shortcuts-item.focus')

  if (focused_item === null) {
    last_item.classList.add('focus')

    $.scrollTo(last_item, SCROLL_ANIMATION_SPEED, {
      axis: 'y'
    })
  } else {
    let prev_item

    for (let [i, item] of items.entries()) {
      if (item.classList.contains('focus')) {
        prev_item = i > 0 ? items[i - 1] : null
        break
      }
    }

    if (prev_item === null) {
      $(document).trigger('shortcuts.to_prev_page')
    } else {
      focused_item.classList.remove('focus')
      prev_item.classList.add('focus')

      $.scrollTo(prev_item, SCROLL_ANIMATION_SPEED, {
        axis: 'y'
      })
    }
  }
})
