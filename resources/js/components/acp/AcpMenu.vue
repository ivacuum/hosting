<script>
import locale from '../../i18n/locale'

export default {
  data() {
    return {
      locale,
      lifeMenu: ['cities', 'countries', 'trips', 'gigs', 'artists', 'tags', 'photos'],
      siteMenu: ['metrics', 'issues', 'users', 'external-identities', 'notifications', 'pages'],
      hostingMenu: ['clients', 'domains', 'servers', 'yandex-users'],
      japaneseMenu: ['kanjis', 'radicals', 'vocabularies'],
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
<header class="bg-light border-b-2 border-grey-200 leading-none">
  <div class="container">
    <div class="flex flex-wrap justify-between items-center w-full">
      <a class="md:hidden site-brand font-bold text-lg text-blueish-700 flex items-center hover:text-orangeish-600 md:mr-3 h-12 text-center" :href="`${locale}/`">vacuum<br>kaluga</a>
      <button class="md:hidden px-4 py-3 text-2xl text-grey-600 hover:text-grey-900 js-collapse" data-target="#header_menu" v-html="$root.svg.three_bars"></button>
      <nav id="header_menu" class="flex md:flex flex-col md:flex-row order-4 md:order-3 md:mr-auto md:items-center whitespace-no-wrap md:whitespace-normal w-full md:w-auto hidden">
        <router-link
          class="md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900"
          :to="{ name: 'acp' }"
          active-class="md:border-blueish-500 text-grey-900"
          exact
        >
          {{ $t('home.index') }}
        </router-link>
        <div class="dropdown">
          <a
            class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle"
            :class="{ 'md:border-blueish-500 text-grey-900': lifeMenuActive }"
            href="#"
            data-toggle="dropdown"
          >
            {{ $t('menu.life') }}
          </a>
          <div class="dropdown-menu leading-normal">
            <router-link
              class="dropdown-item-tw"
              :to="`${locale}/acp/${section}`"
              v-for="section in lifeMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </div>
        <div class="dropdown">
          <a
            class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle"
            :class="{ 'md:border-blueish-500 text-grey-900': hostingMenuActive }"
            href="#"
            data-toggle="dropdown"
          >
            {{ $t('menu.hosting') }}
          </a>
          <div class="dropdown-menu leading-normal">
            <router-link
              class="dropdown-item-tw"
              :to="`${locale}/acp/${section}`"
              v-for="section in hostingMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </div>
        <div class="dropdown">
          <a
            class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle"
            :class="{ 'md:border-blueish-500 text-grey-900': resourcesMenuActive }"
            href="#"
            data-toggle="dropdown"
          >
            {{ $t('menu.resources') }}
          </a>
          <div class="dropdown-menu leading-normal">
            <router-link
              class="dropdown-item-tw"
              :to="`${locale}/acp/${section}`"
              v-for="section in resourcesMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </div>
        <div class="dropdown">
          <a
            class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle"
            :class="{ 'md:border-blueish-500 text-grey-900': japaneseMenuActive }"
            href="#"
            data-toggle="dropdown"
          >
            {{ $t('menu.japanese') }}
          </a>
          <div class="dropdown-menu leading-normal">
            <router-link
              class="dropdown-item-tw"
              :to="`${locale}/acp/${section}`"
              v-for="section in japaneseMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </div>
        <div class="dropdown">
          <a
            class="block md:border-b-2 md:border-transparent md:-mb-2px px-0 md:px-2 py-3 md:py-4 text-grey-600 hover:text-grey-900 outline-none dropdown-toggle"
            :class="{ 'md:border-blueish-500 text-grey-900': siteMenuActive }"
            href="#"
            data-toggle="dropdown"
          >
            {{ $t('menu.site') }}
          </a>
          <div class="dropdown-menu leading-normal">
            <router-link
              class="dropdown-item-tw"
              :to="`${locale}/acp/${section}`"
              v-for="section in siteMenu"
              :key="section"
            >
              {{ $t(`${section}.index`)}}
            </router-link>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>
</template>
