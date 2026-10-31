const absoluteLinkRegexp = /^https?:\/\//
const imageAlignedMaxWidth = Math.round(document.documentElement.clientWidth / 3) + 50
const post = document.getElementById('rutracker_post')
const swing = 'cubic-bezier(0.37, 0, 0.63, 1)'

function convertThumbSrcToOriginal(thumb) {
  return thumb.replace(
    /http(s?):\/\/i(\d+)\.imageban\.ru\/thumbs\/(\d+)\.(\d+)\.(\d+)\/(\w+)\.(\w+)/,
    'http$1://i$2.imageban.ru/out/$3/$4/$5/$6.$7'
  ).replace(
    /http(s?):\/\/img(\d+)\.lostpic\.net\/(\d+)\/(\d+)\/(\d+)\/(\w+)\.th\.(\w+)/,
    'http$1://img$2.lostpic.net/$3/$4/$5/$6.$7'
  )
}

function fitImage(img, maxWidth) {
  if (img.width > maxWidth) {
    img.height = Math.round(maxWidth / img.width * img.height)
    img.width = maxWidth
    img.style.cursor = 'move'

    return false
  }

  if (img.width === maxWidth && img.width < img.naturalWidth) {
    img.height = img.naturalHeight
    img.width = img.naturalWidth

    return false
  }

  return true
}

function getImageLink(item) {
  return item.parentElement.matches('.postLink') ? item.parentElement : null
}

function getOriginalImageFromLink(item) {
  const title = item.getAttribute('title')
  const href = getImageLink(item)?.getAttribute('href')

  if (-1 !== title.search(/fastpic\.ru\/thumb/)) {
    return ''
  } else if (-1 !== title.search(/\.imageban\.ru\/out\//)) {
    return getLinkIfMatches(href, /\.imageban\.ru\/out\//)
  } else if (-1 !== title.search(/\.radikal\.ru/)) {
    return getLinkIfMatches(href, /\.radikal\.ru/)
  } else if (-1 !== title.search(/i\.ibb\.co\//)) {
    return getLinkIfMatches(href, /i\.ibb\.co\//)
  }
}

function getLinkIfMatches(href, regexp) {
  if (!href || -1 === href.search(regexp)) {
    return
  }

  return href
}

function getOriginalSrc(item) {
  const path = item.getAttribute('title')
  const src = convertThumbSrcToOriginal(path)

  if (src !== path) {
    return src
  }

  return getOriginalImageFromLink(item) || path
}

function makeFastpicFullviewLink(item) {
  const link = getImageLink(item)

  if (link !== null && -1 !== item.getAttribute('title').search(/fastpic\.ru\/thumb/)) {
    link.setAttribute('href', link.getAttribute('href').replace(/\/view\//, '/fullview/'))
    link.setAttribute('rel', 'noreferrer')
  }
}

function renderLinks() {
  post.querySelectorAll('.postLink').forEach((link) => {
    const href = link.getAttribute('href')

    if (href !== null && !absoluteLinkRegexp.test(href)) {
      link.setAttribute('href', `https://rutracker.org/forum/${href}`)
    }
  })
}

function renderHr() {
  post.querySelectorAll('.post-hr').forEach((hr) => {
    hr.innerHTML = '<hr class="tLeft">'
  })
}

/**
 * Картинки загружаются только после открытия соответствующего спойлера
 */
function renderImages(root) {
  root.querySelectorAll('var.postImg').forEach((item) => {
    const spoiler = item.closest('.sp-body')

    if (spoiler !== null && spoiler !== root && root.contains(spoiler)) {
      return
    }

    const img = document.createElement('img')
    img.src = getOriginalSrc(item)
    img.className = item.className
    img.alt = 'pic'
    img.referrerPolicy = 'no-referrer'

    makeFastpicFullviewLink(item)

    if (item.classList.contains('postImgAligned')) {
      img.addEventListener('click', (e) => {
        if (!fitImage(img, imageAlignedMaxWidth)) {
          e.preventDefault()
          e.stopPropagation()
        }
      })

      img.addEventListener('load', () => fitImage(img, imageAlignedMaxWidth), { once: true })
    }

    item.replaceChildren(img)
  })
}

function slideToggle(body, open) {
  const collapsed = { height: '0px', paddingTop: '0px', paddingBottom: '0px' }
  const current = body.getAnimations().length ? pickSlideStyle(getComputedStyle(body)) : null

  body.getAnimations().forEach((animation) => animation.cancel())
  body.style.display = 'block'

  const expanded = pickSlideStyle(getComputedStyle(body))
  const keyframes = open ? [current ?? collapsed, expanded] : [current ?? expanded, collapsed]

  body.style.overflow = 'hidden'
  body.animate(keyframes, { duration: 200, easing: swing }).onfinish = () => {
    body.style.overflow = ''

    if (!open) {
      body.style.display = 'none'
    }
  }
}

function pickSlideStyle(style) {
  return { height: style.height, paddingTop: style.paddingTop, paddingBottom: style.paddingBottom }
}

function toggleSpoiler(head) {
  const body = head.nextElementSibling
  const wrap = head.parentElement

  if (!body.classList.contains('inited')) {
    renderImages(body)

    const foldButton = document.createElement('div')
    foldButton.className = 'sp-fold clickable'
    foldButton.textContent = '[свернуть]'
    foldButton.addEventListener('click', () => {
      toggleSpoiler(head)
      head.animate([
        { opacity: 1, easing: swing },
        { opacity: .1, easing: swing, offset: 5 / 12 },
        { opacity: 1 },
      ], 1200)
    })

    body.append(foldButton)
    body.classList.add('flow-root', 'inited')
    wrap.classList.add('flow-root')
  }

  wrap.classList.toggle('sp-opened')
  slideToggle(body, head.classList.toggle('unfolded'))
}

/**
 * Shift+click открывает/закрывает все спойлеры разом
 */
function renderSpoilers() {
  document.addEventListener('click', (e) => {
    const head = e.target.closest('.rutracker-post .sp-head')

    if (head === null) {
      return
    }

    if (!e.shiftKey) {
      toggleSpoiler(head)

      return
    }

    head.style.userSelect = 'none'
    e.stopPropagation()

    const fold = head.classList.contains('unfolded')

    document.querySelectorAll('.rutracker-post .sp-head').forEach((element) => {
      if (element.classList.contains('unfolded') === fold) {
        toggleSpoiler(element)
      }
    })
  })
}

renderHr()
renderImages(post)
renderSpoilers()
renderLinks()
