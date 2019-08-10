<script>
import { mapState } from 'vuex'

import Chat from '../../components/Chat.vue'
import MagnetItem from '../../components/magnets/MagnetItem.vue'
import CategoryTree from '../../components/magnets/CategoryTree.vue'
import SimplePagination from '../../components/SimplePagination.vue'

export default {
  components: {
    MagnetItem,
    Chat,
    CategoryTree,
    SimplePagination,
  },

  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.$store.dispatch('fetchMagnets', to)
    })
  },

  beforeRouteUpdate(to, from, next) {
    this.$store.dispatch('fetchMagnets', to)
      .then(() => {
        next()
      })
  },

  computed: {
    ...mapState({
      meta: state => state.magnets.page.meta,
      guest: state => state.global.guest,
      links: state => state.magnets.page.links,
      loaded: state => state.magnets.loaded,
      magnets: state => state.magnets.page.data,
      categoryList: state => state.magnets.categoryList,
      categoryTree: state => state.magnets.categoryTree,
      categoryStats: state => state.magnets.categoryStats,
    }),

    sameDate() {
      if (!this.magnets.length) return

      let previous
      const result = []

      this.magnets.map(({ registered_at }) => {
        result.push(registered_at === previous)

        previous = registered_at
      })

      return result
    }
  },

  methods: {
    searchUrl(q, fulltext = undefined) {
      return {
        query: { ...this.$route.query, page: undefined, q, fulltext }
      }
    }
  },
}
</script>

<template>
<div>
  <div class="d-flex">
    <aside class="d-none d-lg-block flex-shrink-0 font-smooth torrent-categories" style="width: 14rem;">
      <category-tree/>
      <div class="alert alert-info mr-4 mt-4 p-2 small" v-if="guest">
        <a class="link" href="/auth/login?goto=/torrents">Пользователям</a>
        доступны чат и добавление раздач
      </div>
    </aside>
    <div class="flex-grow-1" v-if="loaded">
      <chat v-if="!guest && !$route.query.q"/>

      <div v-if="$route.query.q">
        <div class="h3">Результаты поиска по запросу «{{ $route.query.q }}»</div>
        <div class="mb-4" v-if="$route.query.fulltext">
          <router-link class="btn btn-default" active-class="noop-active" :to="searchUrl($route.query.q)">
            <span class="text-danger" v-html="$root.svg.times"></span>
            Искать только в заголовках
          </router-link>
        </div>
        <div class="mb-4" v-else>
          <router-link class="btn btn-default" active-class="noop-active" :to="searchUrl($route.query.q, 1)">
            <span v-html="$root.svg.search"></span>
            Искать в описаниях раздач
          </router-link>
        </div>
      </div>

      <div v-if="magnets.length">
        <template v-for="(magnet, i) in magnets">
          <h6 :class="{ 'mt-0': i === 0, 'mt-4': i !== 0 }" v-if="!sameDate[i]">{{ magnet.registered_at }}</h6>
          <magnet-item :magnet="magnet" :category="categoryList[magnet.category_id]"/>
        </template>

        <simple-pagination :meta="meta" :links="links"/>
      </div>
      <div v-else>
        <p class="alert alert-warning">
          Подходящих раздач не найдено.
          <span v-if="$route.query.q && !$route.query.fulltext">
            Можно расширить область поиска с помощью кнопки выше.
          </span>
        </p>

        <details v-if="$route.query.q">
          <summary>Как пользоваться поиском?</summary>
          <div class="mt-2 mb-1">Поиск по раздачам учитывает морфологию русского языка, поэтому «комедия» найдется даже при запросе «комедии». Ниже приведены примеры запросов для понимания особенностей поиска:</div>
          <ul class="text-muted">
            <li>
              <router-link :to="searchUrl('драма')">драма</router-link>
              — кинематограф соответствующей тематики
            </li>
            <li>
              <router-link :to="searchUrl('фантастика 2017')">фантастика 2017</router-link>
              — поиск по теме за 2017 год, порядок слов значения не имеет
            </li>
            <li>
              <router-link :to="searchUrl('россия')">россия</router-link>
              — раздачи российского происхождения
            </li>
            <li>
              <router-link :to="searchUrl('1080p')">1080p</router-link>
              — Full HD качество
            </li>
            <li>
              <router-link :to="searchUrl('original')">original</router-link>
              — только с оригинальной озвучкой
            </li>
            <li>
              <router-link :to="searchUrl('dub')">dub</router-link>
              — дубляж
            </li>
            <li>
              <router-link :to="searchUrl('sub')">sub</router-link>
              — с субтитрами
            </li>
            <li>
              <router-link :to="searchUrl('мост 3 сезон')">мост 3 сезон</router-link>
              — поиск отдельного сезона сериала
            </li>
          </ul>
          <div class="mb-1">Изначально поиск выполняется только по заголовкам раздач. Но его область можно расширить и до их описаний с помощью клика по соответствующей кнопке перед результатами поиска. Это позволяет находить фильмы по актерам, отдельные игры в раздачах антологий и т.п. Примеры:</div>
          <ul class="text-muted">
            <li>
              <router-link :to="searchUrl('мэтт дэймон', 1)">мэтт дэймон</router-link>
              — кино с актером
            </li>
            <li>
              <router-link :to="searchUrl('кубок огня', 1)">кубок огня</router-link>
              — отдельная часть Гарри Поттера в антологии
            </li>
            <li>
              <router-link :to="searchUrl('nfs underground', 1)">nfs underground</router-link>
              — отдельная часть игры в антологии
            </li>
          </ul>
          <p>Как можно было заметить из примеров, порядок слов в запросе не имеет значения. Поэтому, поиск найдет сериал «мир дикого запада» даже при запросе «мир запада» или «запада дикого».</p>
          <p>Однако, поиск не умеет переводить слова, поэтому «office» может не найтись по запросу «офис». Тоже самое касается и пары запросов «фифа» и «fifa». В связи с этим рекомендуется пробовать разные варианты написания.</p>
        </details>
      </div>
    </div>
  </div>
</div>
</template>
