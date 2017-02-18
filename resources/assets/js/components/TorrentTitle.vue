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
      let rgx_test_lead_tags  = /^\s*(\(|\[|\{)/                    // скобка в начале
      let rgx_1st_lead_tags   = /^\s*(\(.+?\)|\[.+?\]|\{.+?\})\s*/  // m[1] = '(tag1, tag2)'
      let rgx_crop_tags       = /[\(\)\[\]\{\}]/g                   // (tag1, tag2) -> tag1, tag2
      let rgx_split_tags      = /\s*[~,\|\/\\]\s*/                  //  tag1, tag2  -> [tag1, tag2]
      let rgx_cleanup_delims  = /([~,\|\/\\])([~,\|\/\\])+/g        //  ,/~~~       -> ,
      let rgx_test_empty_tag  = /[0-9a-zA-Zа-яА-ЯёЁ]/
      let rgx_clean_tag_chars = /"<>/g
      let rgx_cut_leftovers   = /^[^0-9a-zA-Zа-яА-ЯёЁ&\(\[\{]+/     // возможные остатки разделителей в начале названия

      let title = this.title
      let tags_group, tags_apart

      if (rgx_test_lead_tags.test(title)) {
        title = title.replace(rgx_cleanup_delims, '$1')

        let m
        while (m = title.match(rgx_1st_lead_tags)) {
          // удаляем тег из названия
          title = title.replace(m[0], '')
          title = title.replace(rgx_cut_leftovers, '')

          // откат, если от названия ничего не осталось
          if ($.trim(title) == '') {
            title = this.title
            break
          }

          tags_group = m[1].replace(rgx_crop_tags, '')
          tags_group = tags_group.replace(rgx_clean_tag_chars, ' ')
          tags_apart = this.fixTagExceptions($.trim(tags_group))
          tags_apart = tags_apart.split(rgx_split_tags)
          tags_apart = $.grep(tags_apart, function (tag) {
            return rgx_test_empty_tag.test(tag)
          })
        }

        this.html = title.replace(rgx_cut_leftovers, '')
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
