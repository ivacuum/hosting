import locale from './i18n/locale'

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',

  routes: [
    {
      path: `${locale}/japanese/wanikani`,
      component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Layout.vue'),
      children: [
        {
          path: 'kanji',
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Kanjis.vue'),
        },
        {
          name: 'wk.kanji',
          path: 'kanji/:character',
          props: true,
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Kanji.vue'),
        },
        {
          path: 'level',
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Levels.vue'),
        },
        {
          name: 'wk.level',
          path: 'level/:level(\\d+)',
          props: (route) => ({ level: Number(route.params.level) }),
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Level.vue'),
        },
        {
          path: 'radicals',
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Radicals.vue'),
        },
        {
          name: 'wk.radical',
          path: 'radicals/:meaning',
          props: true,
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Radical.vue'),
        },
        {
          path: 'vocabulary',
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Vocabularies.vue'),
        },
        {
          name: 'wk.vocabulary',
          path: 'vocabulary/:characters',
          props: true,
          component: () => import(/* webpackChunkName: "japanese" */'./pages/japanese/Vocabulary.vue'),
        },
      ]
    },
    {
      path: `${locale}/magnets`,
      component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/Layout.vue'),
      children: [
        {
          name: 'magnets',
          // Полный путь, чтобы при поиске к пути не добавлялся слэш в конце
          path: `${locale}/magnets`,
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetList.vue'),
        },
        {
          path: 'add',
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetAdd.vue'),
        },
        {
          path: 'comments',
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetComments.vue'),
        },
        {
          path: 'faq',
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetFaq.vue'),
        },
        {
          path: 'my',
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetMy.vue'),
        },
        {
          name: 'magnet',
          path: ':id(\\d+)',
          props: (route) => ({ level: Number(route.params.id) }),
          component: () => import(/* webpackChunkName: "magnets" */'./pages/magnets/MagnetItem.vue'),
        }
      ]
    }
  ],
})

router.afterEach((to, from) => {
  if (from.fullPath !== '/') {
    document.body.scrollIntoView()
    App.metrika.vueHit(to.fullPath)
  }
})

export default router
