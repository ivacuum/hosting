<?php
/**
 * @var \App\Magnet $magnet
 */
?>

@extends('magnets.base')
@include('jquery')
@include('vue')
@include('livewire')

@section('magnet-download-button')
  @if (Auth::user()?->isRoot())
    <a class="btn btn-default" href="{{ Acp::show($magnet) }}">
      @lang('В админке')
    </a>
  @endif
<div class="mr-4 text-center">
  <a class="btn btn-success js-magnet" href="{{ $magnet->magnet() }}" data-action="{{ to('magnets/{magnet}/magnet', $magnet) }}">
    <span class="mr-1">
      @svg (magnet)
    </span>
    @lang('Магнет')
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($magnet->size) }}
  </a>
</div>
@endsection

@section('content')
<div class="rutracker-post flow-root" id="rutracker_post">
  {!! $magnet->html !!}
</div>

<div class="svg-labels text-muted">
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.updated_at')">
    @svg (calendar-o)
    {{ ViewHelper::dateShort($magnet->registered_at) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.views')">
    @svg (eye)
    {{ ViewHelper::number($magnet->views) }}
  </span>
  <span class="svg-flex svg-label svg-muted tooltipped tooltipped-n" aria-label="@lang('model.magnet.clicks')">
    @svg (magnet)
    {{ ViewHelper::number($magnet->clicks) }}
  </span>
  <a class="svg-flex svg-muted tooltipped tooltipped-n" href="{{ $magnet->externalLink() }}" aria-label="@lang('Первоисточник')">
    @svg (external-link)
  </a>
  <a class="btn btn-success svg-flex svg-label js-magnet" href="{{ $magnet->magnet() }}" data-action="{{ to('magnets/{magnet}/magnet', $magnet) }}">
    @svg (magnet)
    @lang('Магнет')
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($magnet->size) }}
  </a>
</div>

@if (count($tags = $magnet->titleTags()))
  <div class="mt-4">
    @foreach ($tags as $tag)
      <a
        class="border border-blueish-700 rounded mb-1 px-2 py-1 text-sm text-blueish-700 lowercase hover:bg-blueish-700 hover:text-white"
        href="{{ to('magnets', ['q' => mb_strtolower($tag)]) }}"
      >#{{ $tag }}</a>
    @endforeach
  </div>
@endif

@if (($relatedTorrents = $magnet->relatedTorrents())?->count())
  <div class="font-medium text-2xl mb-2 mt-12">
    @lang('Связанные раздачи')
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </div>
  <?php /** @var \App\Magnet $row */ ?>
  @foreach ($relatedTorrents as $row)
    <div class="flex flex-wrap md:flex-nowrap justify-center md:justify-start torrents-list-container antialiased js-torrents-views-observer" data-id="{{ $row->id }}">
      <div class="flex-shrink-0 w-8 torrent-icon order-1 md:order-none mr-1 md:text-2xl" title="{{ $row->category_id->title() }}">
        <?php $icon = $row->category_id->icon() ?>
        @svg ($icon)
      </div>
      <a class="grow mb-2 md:mb-0 md:mr-4 visited" href="{{ $row->www() }}">
        @if (Auth::user()?->torrent_short_title)
          <div>{{ $row->shortTitle() }}</div>
        @else
          <div class="font-bold">
            <x-magnet-title>{{ $row->title }}</x-magnet-title>
          </div>
        @endif
      </a>
      <a class="flex-shrink-0 pr-2 torrents-list-magnet text-center md:text-left whitespace-nowrap js-magnet"
         href="{{ $row->magnet() }}"
         title="@lang('Магнет')"
         data-action="{{ to('magnets/{magnet}/magnet', $row) }}"
      >
        @svg (magnet)
        <span class="js-magnet-counter">{{ $row->clicks ?: '' }}</span>
      </a>
      <div class="flex-shrink-0 text-center md:text-left whitespace-nowrap torrents-list-size">{{ ViewHelper::size($row->size) }}</div>
    </div>
  @endforeach
@endif

@livewire(App\Http\Livewire\Comments::class, ['model' => $magnet])
@livewire(App\Http\Livewire\CommentAddForm::class, ['model' => $magnet])
@endsection

@push('js')
<script>
(function () {
  const app = Vue.createApp({
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

    unmounted() {
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
            $(item).attr('href', `https://rutracker.org/forum/${href}`)
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
              // $.scrollTo($head, {
              //   duration: 200,
              //   axis: 'y',
              //   offset: -200,
              // })

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
  })

  app.mount('#rutracker_post')
})()
</script>
@endpush
