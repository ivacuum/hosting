import $ from 'jquery'

const absoluteLinkRegexp = /^https?:\/\//
const imageAlignedMaxWidth = Math.round(document.documentElement.clientWidth / 3) + 50

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

function getOriginalImageFromLink($item) {
  const title = $item.attr('title')
  const href = $item.parent('.postLink').attr('href')

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

function getOriginalSrc($item) {
  const path = $item.attr('title')
  const src = convertThumbSrcToOriginal(path)

  if (src !== path) {
    return src
  }

  return getOriginalImageFromLink($item) || path
}

function makeFastpicFullviewLink($item) {
  const title = $item.attr('title')

  if (-1 !== title.search(/fastpic\.ru\/thumb/)) {
    const $link = $item.parent('.postLink')

    $link.attr('href', $link.attr('href').replace(/\/view\//, '/fullview/'))
    $link.attr('rel', 'noreferrer')
  }
}

function renderLinks() {
  $('.postLink', '.rutracker-post').each((index, item) => {
    const href = $(item).attr('href')

    if (!absoluteLinkRegexp.test(href)) {
      $(item).attr('href', `https://rutracker.org/forum/${href}`)
    }
  })
}

function renderHr() {
  $('.post-hr', '.rutracker-post').html('<hr class="tLeft">')
}

function renderImages(context) {
  const $inSpoilers = $('.sp-body var.postImg', context)

  $('var.postImg', context).not($inSpoilers).each((index, item) => {
    const $item = $(item)
    const src = getOriginalSrc($item)
    const cls = $item.attr('class')

    makeFastpicFullviewLink($item)

    const $img = $(`<img src="${src}" class="${cls}" alt="pic" referrerpolicy="no-referrer">`)

    if ($item.hasClass('postImgAligned')) {
      $img.on('click', (e) => fitImage(e.currentTarget, imageAlignedMaxWidth))
      $img.one('load', (e) => fitImage(e.currentTarget, imageAlignedMaxWidth))
    }

    $item.empty().append($img)
  })
}

function renderSpoilers() {
  $(document).on('click.spoiler', '.rutracker-post .sp-head', (e) => {
    const $head = $(e.currentTarget)
    const $body = $head.next('.sp-body')
    const $wrap = $head.parent('.sp-wrap')

    if (!$body.hasClass('inited')) {
      renderImages($body)

      const $foldBtn = $('<div class="sp-fold clickable">[свернуть]</div>').on('click', () => {
        $head
          .click()
          .animate({ opacity: .1 }, 500)
          .animate({ opacity: 1 }, 700)
      })

      $body.append($foldBtn).addClass('flow-root inited')
      $body.parent().addClass('flow-root')
    }

    if (e.shiftKey) {
      $head.css('user-select', 'none')
      e.stopPropagation()
      e.shiftKey = false

      const fold = $head.hasClass('unfolded')

      $('.sp-head').filter(function () {
        return $(this).hasClass('unfolded') ? fold : !fold
      }).click()
    } else {
      $head.toggleClass('unfolded')
      $wrap.toggleClass('sp-opened')
      $body.slideToggle('fast')
    }
  })
}

renderHr()
renderImages('.rutracker-post')
renderSpoilers()
renderLinks()
