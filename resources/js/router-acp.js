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
