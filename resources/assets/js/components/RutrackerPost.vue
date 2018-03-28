<template>
  <div class="rutracker-post" v-once>
    <slot></slot>
  </div>
</template>

<script>
export default {
  data() {
    return {
      absolute_link_regexp: new RegExp("^https?://"),
      image_aligned_max_width: 0,
    }
  },

  mounted() {
    this.image_aligned_max_width = Math.round(document.documentElement.clientWidth / 3) + 50
    this.initPost()
  },

  methods: {
    convertThumbSrcToOriginal(thumb) {
      return thumb.replace(
          /http(s?):\/\/i(\d+)\.imageban\.ru\/thumbs\/(\d+)\.(\d+)\.(\d+)\/([a-z\d]+)\.([a-z]+)/,
          'http$1://i$2.imageban.ru/out/$3/$4/$5/$6.$7'
      ).replace(
          /https?:\/\/s(\d+)\.radikal\.ru\/i(\d+)\/(\d+)\/([a-z\d]+)\/([a-z\d]+)t\.([a-z]+)/,
          'https://s$1.radikal.ru/i$2/$3/$4/$5.$6'
      )
    },

    fitImage(a, b) {
      return "undefined" == typeof a.naturalHeight && (a.naturalHeight = a.height, a.naturalWidth = a.width), a.width > b ? (a.height = Math.round(b / a.width * a.height), a.width = b, a.style.cursor = "move", !1) : !(a.width == b && a.width < a.naturalWidth) || (a.height = a.naturalHeight, a.width = a.naturalWidth, !1)
    },

    getOriginalImageFromLink($item) {
      if (!$item.attr('title').search(/fastpic\.ru/)) {
        return
      }

      const href = $item.parent('.postLink').attr('href')

      if (!href || -1 === href.search(/fastpic\.ru/)) {
        return
      }

      const src = href.replace(
          /https?:\/\/fastpic\.ru\/view\/(\d+)\/(\d+)\/([a-z\d]+)\/((?:[a-z\d]+)([a-z\d]{2}))\.([a-z]+)\.html/,
          'https://i$1.fastpic.ru/big/$2/$3/$5/$4.$6'
      )

      return src !== href ? src : ''
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

    renderLinks() {
      $('.postLink', '.rutracker-post').each((index, item) => {
        let href = $(item).attr('href')
        if (!this.absolute_link_regexp.test(href)) {
          $(item).attr('href', `https://rutracker.cr/forum/${href}`)
        }
      })
    },

    renderHr() {
      $('.post-hr', '.rutracker-post').html('<hr class="tLeft">')
    },

    renderImages(context) {
      let $in_spoilers = $('.sp-body var.postImg', context)

      $('var.postImg', context).not($in_spoilers).each((index, item) => {
        let $item = $(item)
        let src = this.getOriginalSrc($item)
        let cls = $item.attr('class')

        let $img = $(`<img src="${src}" class="${cls}" alt="pic">`)

        if ($item.hasClass('postImgAligned')) {
          $img.on('click', (e) => {
            return this.fitImage(e.currentTarget, this.image_aligned_max_width)
          })

          $img.one('load', (e) => {
            this.fitImage(e.currentTarget, this.image_aligned_max_width)
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

          let $fold_btn = $('<div class="sp-fold clickable">[свернуть]</div>').on('click', function () {
            $.scrollTo($head, {
              duration: 200,
              axis: 'y',
              offset: -200,
            })

            $head.click()
              .animate({ opacity: .1 }, 500)
              .animate({ opacity: 1 }, 700)
          })

          $body.append($fold_btn).addClass('clearfix inited')
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
