<script>
import locale from '../../i18n/locale'

export default {
  data() {
    return {
      locale,
      lifeMenu: ['cities', 'countries', 'trips', 'gigs', 'artists', 'tags', 'photos'],
      siteMenu: ['metrics', 'issues', 'users', 'external-identities', 'notifications', 'pages'],
      hostingMenu: ['clients', 'domains', 'servers', 'yandex-users'],
      japaneseMenu: ['kanji', 'radicals', 'vocabularies'],
      resourcesMenu: ['chat-messages', 'comments', 'dcpp-hubs', 'files', 'news', 'images', 'torrents'],
    }
  },

  computed: {
    hostingMenuActive() {
      return this.hostingMenu.some((el) => this.$route.path.startsWith(`${this.locale}/acp/${el}`))
    },

    japaneseMenuActive() {
      return this.japaneseMenu.some((el) => this.$route.path.startsWith(`${this.locale}/acp/${el}`))
    },

    lifeMenuActive() {
      return this.lifeMenu.some((el) => this.$route.path.startsWith(`${this.locale}/acp/${el}`))
    },

    resourcesMenuActive() {
      return this.resourcesMenu.some((el) => this.$route.path.startsWith(`${this.locale}/acp/${el}`))
    },

    siteMenuActive() {
      return this.siteMenu.some((el) => this.$route.path.startsWith(`${this.locale}/acp/${el}`))
    },
  }
}
</script>

<template>
<div class="navbar navbar-border navbar-expand-md py-md-0 navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto align-items-md-center">
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'acp' }" exact>
            {{ $t('menu.index') }}
          </router-link>
        </li>
        <li class="nav-item dropdown" :class="{ active: lifeMenuActive }">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ $t('menu.life') }}
          </a>
          <div class="dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="`${locale}/acp/${section}`"
              v-for="section in lifeMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </li>
        <li class="nav-item dropdown" :class="{ active: hostingMenuActive }">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ $t('menu.hosting') }}
          </a>
          <div class="dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="`${locale}/acp/${section}`"
              v-for="section in hostingMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </li>
        <li class="nav-item dropdown" :class="{ active: resourcesMenuActive }">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ $t('menu.resources') }}
          </a>
          <div class="dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="`${locale}/acp/${section}`"
              v-for="section in resourcesMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </li>
        <li class="nav-item dropdown" :class="{ active: japaneseMenuActive }">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ $t('menu.japanese') }}
          </a>
          <div class="dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="`${locale}/acp/${section}`"
              v-for="section in japaneseMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </li>
        <li class="nav-item dropdown" :class="{ active: siteMenuActive }">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            {{ $t('menu.site') }}
          </a>
          <div class="dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="`${locale}/acp/${section}`"
              v-for="section in siteMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</template>
