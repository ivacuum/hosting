import locale from './i18n/locale'

export default new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',

  routes: [
    {
      path: `${locale}/acp`,
      component: { render: h => h('router-view') },
      children: [
        { path: '/', name: 'acp', component: () => import(/* webpackChunkName: "acp" */'./components/acp/AcpDashboard.vue') },
        { path: 'quiz', component: () => import(/* webpackChunkName: "trainers" */'./components/trainer/Quiz.vue') },

        { path: 'cities', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Cities/Index.vue') },
        { path: 'cities/create', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Cities/Form.vue') },
        {
          path: 'cities/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/Cities/Layout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Cities/Show.vue') },
            { path: 'edit', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Cities/Form.vue') },
          ],
        },

        { path: 'countries', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Countries/Index.vue') },
        { path: 'countries/create', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Countries/Form.vue') },
        {
          path: 'countries/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/DefaultItemLayout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Countries/Show.vue') },
            { path: 'edit', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Countries/Form.vue') },
          ],
        },

        { path: 'gigs', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Gigs/Index.vue') },
        { path: 'gigs/create', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Gigs/Form.vue') },
        {
          path: 'gigs/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/Gigs/Layout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Gigs/Show.vue') },
            { path: 'edit', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Gigs/Form.vue') },
          ],
        },
      ],
    },
  ],
})
