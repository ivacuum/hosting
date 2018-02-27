// Горячие клавиши
let shortcuts_enabled = true

$(document).on('focus', 'input,textarea,select', function () {
  shortcuts_enabled = false
})

$(document).on('blur', 'input,textarea,select', function () {
  shortcuts_enabled = true
})

if ($('.js-shortcuts-items').length) {
  let shortcuts_items = $('.js-shortcuts-items .shortcuts-item')

  $(window).scroll(function () {
    let active_start_position = window.pageYOffset
    let active_end_position = window.pageYOffset + 50

    shortcuts_items.each(function (index, item) {
      let shortcuts_item = $(item)
      let shortcuts_item_position = shortcuts_item.offset().top + 20

      if (active_start_position < shortcuts_item_position && shortcuts_item_position < active_end_position) {
        if (shortcuts_item.hasClass('focus')) {} else {
          $('.js-shortcuts-items .shortcuts-item.focus').removeClass('focus')
          shortcuts_item.addClass('focus')
        }
      }
    })
  })
}

$(document).on('keyup', 'body', function (e) {
  if (shortcuts_enabled) {
    if ((e.altKey || e.ctrlKey || e.metaKey) && e.which === 37) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_prev_page')
    }

    if ((e.altKey || e.ctrlKey || e.metaKey) && e.which === 39) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_next_page')
    }
  }
})

$(document).on('keypress', 'body', function (e) {
  let not_meta_key = !e.altKey && !e.ctrlKey && !e.metaKey

  if (shortcuts_enabled) {
    // if ((e.which === 47 || e.which === 46) && not_meta_key) {
    //   e.preventDefault()
    //
    //   $(document).trigger('shortcuts.focus_to_search')
    // }

    if ((e.which === 104 || e.which === 1088) && not_meta_key) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_first_post')
    }
    if ((e.which === 108 || e.which === 1076) && not_meta_key) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_last_post')
    }
    if ((e.which === 106 || e.which === 1086) && not_meta_key) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_next_post')
    }

    if ((e.which === 107 || e.which === 1083) && not_meta_key) {
      e.preventDefault()

      $(document).trigger('shortcuts.to_prev_post')
    }
  }
})

// $(document).on('shortcuts.focus_to_search', function (event, form) {
//   $('.nav_panel .tab_menu').click()
//   $('.global_search_form input[name="q"]').focus()
// })

$(document).on('shortcuts.to_next_page', function () {
  let $link = $('#next_page')
  let url = $link.attr('href')

  if (typeof url !== 'undefined') {
    if ($link.hasClass('js-pjax')) {
      $.pjax({ url, container: '#pjax_container' })
    } else {
      document.location.href = url
    }
  }
})

$(document).on('shortcuts.to_prev_page', function () {
  let $link = $('#previous_page')
  let url = $link.attr('href')

  if (typeof url !== 'undefined') {
    if ($link.hasClass('js-pjax')) {
      $.pjax({ url, container: '#pjax_container' })
    } else {
      document.location.href = url
    }
  }
})

$(document).on('shortcuts.to_first_post', function () {
  let shortcuts_items = $('.js-shortcuts-items')

  if (shortcuts_items.length) {
    if ($('.shortcuts-item', shortcuts_items).first().hasClass('focus')) {
      $(document).trigger('shortcuts.to_prev_page')
    } else {
      $('.shortcuts-item.focus', shortcuts_items).removeClass('focus')
      $('.shortcuts-item', shortcuts_items).first().addClass('focus')
    }

    $.scrollTo($('.shortcuts-item.focus', shortcuts_items), 200, {
      axis: 'y'
    })
  }
})

$(document).on('shortcuts.to_last_post', function () {
  let shortcuts_items = $('.js-shortcuts-items')

  if (shortcuts_items.length) {
    if ($('.shortcuts-item', shortcuts_items).last().hasClass('focus')) {
      $(document).trigger('shortcuts.to_next_page')
    } else {
      $('.shortcuts-item.focus', shortcuts_items).removeClass('focus')
      $('.shortcuts-item', shortcuts_items).last().addClass('focus')
    }

    $.scrollTo($('.shortcuts-item.focus', shortcuts_items), 200, {
      axis: 'y'
    })
  }
})

$(document).on('shortcuts.to_next_post', function () {
  let shortcuts_items = $('.js-shortcuts-items')

  if (shortcuts_items.length) {
    if ($('.shortcuts-item.focus', shortcuts_items).length === 0) {
      $('.shortcuts-item', shortcuts_items).first().addClass('focus')
    } else {
      let shortcuts_item = $('.shortcuts-item.focus', shortcuts_items)
      let next_shortcuts_item = shortcuts_item.next()

      if (next_shortcuts_item.length === 0) {
        $(document).trigger('shortcuts.to_next_page')
      } else {
        shortcuts_item.removeClass('focus')
        next_shortcuts_item.addClass('focus')
      }
    }

    $.scrollTo($('.shortcuts-item.focus', shortcuts_items), 200, {
      axis: 'y'
    })
  }
})

$(document).on('shortcuts.to_prev_post', function () {
  let shortcuts_items = $('.js-shortcuts-items')

  if (shortcuts_items.length) {
    if ($('.shortcuts-item.focus', shortcuts_items).length === 0) {
      $('.shortcuts-item', shortcuts_items).last().addClass('focus')
    } else {
      let shortcuts_item = $('.shortcuts-item.focus', shortcuts_items)
      let prev_shortcuts_item = shortcuts_item.prev()

      if (prev_shortcuts_item.length === 0) {
        $(document).trigger('shortcuts.to_prev_page')
      } else {
        shortcuts_item.removeClass('focus')
        prev_shortcuts_item.addClass('focus')
      }
    }

    $.scrollTo($('.shortcuts-item.focus', shortcuts_items), 200, {
      axis: 'y'
    })
  }
})
