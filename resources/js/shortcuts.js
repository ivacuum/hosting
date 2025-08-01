export default class Shortcuts {
  static bind() {
    const NEXT_PAGE_SELECTOR = '#next_page'
    const PREV_PAGE_SELECTOR = '#prev_page'

    Mousetrap.bind(['ctrl+left', 'alt+left'], () => {
      document.dispatchEvent(new Event('shortcuts.to_prev_page'))
    })

    Mousetrap.bind(['ctrl+right', 'alt+right'], () => {
      document.dispatchEvent(new Event('shortcuts.to_next_page'))
    })

    Mousetrap.bind('ctrl+enter', () => {
      const selection = window.getSelection().toString()

      if (selection.length > 200) {
        alert('Selection is too long')
        return
      }

      if (selection.length < 3) {
        return
      }

      fetch('/js/typo', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
        },
        body: JSON.stringify({ selection }),
      })
        .then(response => response.json())
        .then(json => alert(json.message))
    }, 'keyup')

    // Русские буквы
    Mousetrap.addKeycodes({
      1088: 'h', // р
      1076: 'j', // о
      1086: 'k', // л
      1083: 'l', // д
    })

    Mousetrap.bind('alt+e', () => {
      document.dispatchEvent(new Event('shortcuts.english'))
    })

    Mousetrap.bind('alt+r', () => {
      document.dispatchEvent(new Event('shortcuts.russian'))
    })

    Mousetrap.bind('h', () => {
      document.dispatchEvent(new Event('shortcuts.to_first_post'))
    })

    Mousetrap.bind('j', () => {
      document.dispatchEvent(new Event('shortcuts.to_next_post'))
    })

    Mousetrap.bind('k', () => {
      document.dispatchEvent(new Event('shortcuts.to_prev_post'))
    })

    Mousetrap.bind('l', () => {
      document.dispatchEvent(new Event('shortcuts.to_last_post'))
    })

    Mousetrap.bind('/', () => {
      const search = document.querySelector('.js-search-input')

      if (search !== null) {
        search.focus()
      }
    }, 'keyup')

    document.addEventListener('shortcuts.english', () => {
      document.querySelector('.js-english')?.click()
    })

    document.addEventListener('shortcuts.russian', () => {
      document.querySelector('.js-russian')?.click()
    })

    document.addEventListener('shortcuts.redirect', (e) => {
      const link = document.querySelector(e.detail.selector)

      if (!link) return false

      const url = link.getAttribute('href')

      if (!url) return false

      document.location.href = url

      return true
    })

    document.addEventListener('shortcuts.to_next_page', () => {
      document.dispatchEvent(new CustomEvent('shortcuts.redirect', {
        detail: { selector: NEXT_PAGE_SELECTOR },
      }))
    })

    document.addEventListener('shortcuts.to_prev_page', () => {
      document.dispatchEvent(new CustomEvent('shortcuts.redirect', {
        detail: { selector: PREV_PAGE_SELECTOR },
      }))
    })

    document.addEventListener('shortcuts.to_first_post', () => {
      const firstItem = document.querySelector('.js-shortcuts-item')

      if (firstItem === null) return false

      if (firstItem.matches('.focus')) {
        document.dispatchEvent(new Event('shortcuts.to_prev_page'))
      } else {
        const focusedItem = document.querySelector('.js-shortcuts-item.focus')

        if (focusedItem !== null) {
          focusedItem.classList.remove('focus')
        }

        firstItem.classList.add('focus')
        firstItem.scrollIntoView()
      }

      return true
    })

    document.addEventListener('shortcuts.to_last_post', () => {
      const items = [...document.querySelectorAll('.js-shortcuts-item')]

      if (items.length === 0) return false

      const lastItem = items[items.length - 1]

      if (lastItem.matches('.focus')) {
        document.dispatchEvent(new Event('shortcuts.to_next_page'))
      } else {
        const focusedItem = document.querySelector('.js-shortcuts-item.focus')

        if (focusedItem !== null) {
          focusedItem.classList.remove('focus')
        }

        lastItem.classList.add('focus')
        lastItem.scrollIntoView()
      }

      return true
    })

    document.addEventListener('shortcuts.to_next_post', () => {
      const firstItem = document.querySelector('.js-shortcuts-item')

      if (firstItem === null) return false

      const focusedItem = document.querySelector('.js-shortcuts-item.focus')

      if (focusedItem === null) {
        firstItem.classList.add('focus')
        firstItem.scrollIntoView()
      } else {
        const items = [...document.querySelectorAll('.js-shortcuts-item')]
        let nextItem = null

        items.some((item, i) => {
          if (item.matches('.focus')) {
            nextItem = items.length > i + 1 ? items[i + 1] : null
            return true
          }

          return false
        })

        if (nextItem === null) {
          document.dispatchEvent(new Event('shortcuts.to_next_page'))
        } else {
          focusedItem.classList.remove('focus')
          nextItem.classList.add('focus')
          nextItem.scrollIntoView()
        }
      }

      return true
    })

    document.addEventListener('shortcuts.to_prev_post', () => {
      const items = [...document.querySelectorAll('.js-shortcuts-item')]

      if (items.length === 0) return false

      const lastItem = items[items.length - 1]
      const focusedItem = document.querySelector('.js-shortcuts-item.focus')

      if (focusedItem === null) {
        lastItem.classList.add('focus')
        lastItem.scrollIntoView()
      } else {
        let prevItem = null

        items.some((item, i) => {
          if (item.matches('.focus')) {
            prevItem = i > 0 ? items[i - 1] : null
            return true
          }

          return false
        })

        if (prevItem === null) {
          document.dispatchEvent(new Event('shortcuts.to_prev_page'))
        } else {
          focusedItem.classList.remove('focus')
          prevItem.classList.add('focus')
          prevItem.scrollIntoView()
        }
      }

      return true
    })
  }
}
