/* global VueRouter */
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

        { path: 'issues', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Issues/Index.vue') },
        {
          path: 'issues/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/DefaultItemLayout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Issues/Show.vue') },
          ],
        },

        { path: 'trips', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Trips/Index.vue') },
        { path: 'trips/create', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Trips/Form.vue') },
        {
          path: 'trips/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/Trips/Layout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Trips/Show.vue') },
            { path: 'edit', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Trips/Form.vue') },
          ],
        },
      ],
    },
  ],
})
