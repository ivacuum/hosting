<template>
  <div class="rutracker-post clearfix">
    <slot/>
  </div>
</template>

<script>
export default {
  data() {
    return {
      absoluteLinkRegexp: new RegExp("^https?://"),
      imageAlignedMaxWidth: 0,
    }
  },

  mounted() {
    this.imageAlignedMaxWidth = Math.round(document.documentElement.clientWidth / 3) + 50
    this.initPost()
  },

  destroyed() {
    $(document).off('click.spoiler', '.rutracker-post .sp-head')
    $(document).off('click', '.sp-fold')
    $(document).off('click', '.postImg')
    $(document).off('load', '.postImg')
  },

  methods: {
    convertThumbSrcToOriginal(thumb) {
      return thumb.replace(
          /http(s?):\/\/i(\d+)\.imageban\.ru\/thumbs\/(\d+)\.(\d+)\.(\d+)\/(\w+)\.(\w+)/,
          'http$1://i$2.imageban.ru/out/$3/$4/$5/$6.$7'
      ).replace(
          /http(s?):\/\/img(\d+)\.lostpic\.net\/(\d+)\/(\d+)\/(\d+)\/(\w+)\.th\.(\w+)/,
          'http$1://img$2.lostpic.net/$3/$4/$5/$6.$7'
      )/*.replace(
          /https?:\/\/s(\d+)\.radikal\.ru\/i(\d+)\/(\d+)\/([a-z\d]+)\/([a-z\d]+)t\.([a-z]+)/,
          'https://s$1.radikal.ru/i$2/$3/$4/$5.$6'
      )*/
    },

    fitImage(a, b) {
      return "undefined" === typeof a.naturalHeight && (a.naturalHeight = a.height, a.naturalWidth = a.width), a.width > b ? (a.height = Math.round(b / a.width * a.height), a.width = b, a.style.cursor = "move", !1) : !(a.width == b && a.width < a.naturalWidth) || (a.height = a.naturalHeight, a.width = a.naturalWidth, !1)
    },

    getOriginalImageFromLink($item) {
      const title = $item.attr('title')

      if (-1 !== title.search(/fastpic\.ru\/thumb/)) {
        return ''
        // return this.getOriginalFastpicSrc($item.parent('.postLink').attr('href'))
      } else if (-1 !== title.search(/\.imageban\.ru\/out\//)) {
        return this.getOriginalImagebanSrc($item.parent('.postLink').attr('href'))
      } else if (-1 !== title.search(/\.radikal\.ru/)) {
        return this.getOriginalRadikalSrc($item.parent('.postLink').attr('href'))
      }
    },

    getOriginalFastpicSrc(path) {
      if (!path || -1 === path.search(/fastpic\.ru/)) {
        return
      }

      const src = path.replace(
          /https?:\/\/fastpic\.ru\/view\/(\d+)\/(\d+)\/(\w+)\/((?:\w+)(\w{2}))\.(\w+)\.html/,
          'https://i$1.fastpic.ru/big/$2/$3/$5/$4.$6?noht=1'
      )

      return src !== path ? src : ''
    },

    getOriginalImagebanSrc(path) {
      if (!path || -1 === path.search(/\.imageban\.ru\/out\//)) {
        return
      }

      return path
    },

    getOriginalRadikalSrc(path) {
      if (!path || -1 === path.search(/\.radikal\.ru/)) {
        return
      }

      return path
    },

    getOriginalSrc($item) {
      const path = $item.attr('title')

      let src = this.convertThumbSrcToOriginal(path)

      if (src !== path) {
        return src
      }

      let linkSrc = this.getOriginalImageFromLink($item)

      return linkSrc ? linkSrc : path
    },

    initPost() {
      this.renderHr()
      this.renderImages('.rutracker-post')
      this.renderSpoilers()
      this.renderLinks()
    },

    makeFastpicFullviewLink($item) {
      const title = $item.attr('title')

      if (-1 !== title.search(/fastpic\.ru\/thumb/)) {
        const $link = $item.parent('.postLink')
        const linkHref = $link.attr('href')

        $link.attr('href', linkHref.replace(/\/view\//, '/fullview/'))
        $link.attr('rel', 'noreferrer')
      }
    },

    renderLinks() {
      $('.postLink', '.rutracker-post').each((index, item) => {
        let href = $(item).attr('href')
        if (!this.absoluteLinkRegexp.test(href)) {
          $(item).attr('href', `https://rutracker.nl/forum/${href}`)
        }
      })
    },

    renderHr() {
      $('.post-hr', '.rutracker-post').html('<hr class="tLeft">')
    },

    renderImages(context) {
      let $inSpoilers = $('.sp-body var.postImg', context)

      $('var.postImg', context).not($inSpoilers).each((index, item) => {
        let $item = $(item)
        let src = this.getOriginalSrc($item)
        let cls = $item.attr('class')

        this.makeFastpicFullviewLink($item)

        let $img = $(`<img src="${src}" class="${cls}" alt="pic" referrerpolicy="no-referrer">`)

        if ($item.hasClass('postImgAligned')) {
          $img.on('click', (e) => {
            return this.fitImage(e.currentTarget, this.imageAlignedMaxWidth)
          })

          $img.one('load', (e) => {
            this.fitImage(e.currentTarget, this.imageAlignedMaxWidth)
          })
        }

        $item.empty().append($img)
      })
    },

    renderSpoilers() {
      $(document).on('click.spoiler', '.rutracker-post .sp-head', (e) => {
        let $head = $(e.currentTarget)
        let $body = $head.next('.sp-body')
        let $wrap = $head.parent('.sp-wrap')

        if (!$body.hasClass('inited')) {
          this.renderImages($body)

          let $foldBtn = $('<div class="sp-fold clickable">[свернуть]</div>').on('click', function () {
            $.scrollTo($head, {
              duration: 200,
              axis: 'y',
              offset: -200,
            })

            $head
              .click()
              .animate({ opacity: .1 }, 500)
              .animate({ opacity: 1 }, 700)
          })

          $body.append($foldBtn).addClass('clearfix inited')
          $body.parent().addClass('clearfix')
        }

        if (e.shiftKey) {
          $head.css('user-select', 'none')
          e.stopPropagation()
          e.shiftKey = false

          let fold = $head.hasClass('unfolded')

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
  }
}
</script>
