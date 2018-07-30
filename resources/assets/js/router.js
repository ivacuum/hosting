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

        { path: 'artists', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Artists/Index.vue') },
        { path: 'artists/create', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Artists/Form.vue') },
        {
          path: 'artists/:id',
          component: () => import(/* webpackChunkName: "acp" */'./components/acp/DefaultItemLayout.vue'),
          children: [
            { path: '/', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Artists/Show.vue') },
            { path: 'edit', component: () => import(/* webpackChunkName: "acp" */'./components/acp/Artists/Form.vue') },
          ],
        },

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
