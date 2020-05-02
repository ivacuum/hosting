<template>
  <span class="torrent-title" :class="{ 'hide-brackets': hide_brackets }" v-html="html"></span>
</template>

<script>
export default {
  props: ['title', 'hide_brackets'],

  data() {
    return {
      html: '',
    }
  },

  mounted() {
    this.html = this.title

    this.divideTitleTags()
    this.highlightTextInBrackets()
  },

  methods: {
    // Выделение тегов и текста в скобках
    divideTitleTags() {
      let rgxCropTags = /[\(\)\[\]\{\}]/g // (tag1, tag2) -> tag1, tag2
      let rgxSplitTags = /\s*[~,\|\/\\]\s*/ //  tag1, tag2  -> [tag1, tag2]
      let rgxCutLeftovers = /^[^0-9a-zA-Zа-яА-ЯёЁ&\(\[\{]+/ // возможные остатки разделителей в начале названия
      let rgxTestEmptyTag = /[0-9a-zA-Zа-яА-ЯёЁ]/
      let rgxTestLeadTags = /^\s*(\(|\[|\{)/ // скобка в начале
      let rgxCleanTagChars = /"<>/g
      let rgxCleanupDelims = /([~,\|\/\\])([~,\|\/\\])+/g //  ,/~~~       -> ,
      let rgxFirstLeadTags = /^\s*(\(.+?\)|\[.+?\]|\{.+?\})\s*/ // m[1] = '(tag1, tag2)'

      let title = this.title
      let tagsGroup, tagsApart

      if (rgxTestLeadTags.test(title)) {
        title = title.replace(rgxCleanupDelims, '$1')

        let m
        while (m = title.match(rgxFirstLeadTags)) {
          // удаляем тег из названия
          title = title.replace(m[0], '')
          title = title.replace(rgxCutLeftovers, '')

          // откат, если от названия ничего не осталось
          if ($.trim(title) === '') {
            title = this.title
            break
          }

          tagsGroup = m[1].replace(rgxCropTags, '')
          tagsGroup = tagsGroup.replace(rgxCleanTagChars, ' ')
          tagsApart = this.fixTagExceptions($.trim(tagsGroup))
          tagsApart = tagsApart.split(rgxSplitTags)
          tagsApart = $.grep(tagsApart, function (tag) {
            return rgxTestEmptyTag.test(tag)
          })
        }

        this.html = title.replace(rgxCutLeftovers, '')
      }
    },

    fixTagExceptions(txt) {
      txt = txt.replace(/^\s*([\d.]+)\s*([\/\\])\s*([\d.]+)\s*$/, '$1&#47;$3') // [24/192] [16/44.1]
      return $.trim(txt)
    },

    highlightTextInBrackets() {
      this.html = this.html.replace(/(\(.+?\)|\[.+?\]|\{.+?\})/g, '<span class="torrent-brackets">$1</span>')
    }
  }
}
</script>
