/* global VueRouter */
import locale from './i18n/locale'

import Dashboard from './components/acp/AcpDashboard.vue'
import IssueShow from './components/acp/Issues/Show.vue'
import IssueLayout from './components/acp/Issues/Layout.vue'
import IssuesIndex from './components/acp/Issues/Index.vue'
import TripForm from './components/acp/Trips/Form.vue'
import TripShow from './components/acp/Trips/Show.vue'
import TripLayout from './components/acp/Trips/Layout.vue'
import TripsIndex from './components/acp/Trips/Index.vue'

export default new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',

  routes: [
    {
      path: `${locale}/acp`,
      component: { render: h => h('router-view') },
      children: [
        { path: '/', name: 'acp', component: Dashboard },

        { path: 'issues', component: IssuesIndex },
        {
          path: 'issues/:id',
          component: IssueLayout,
          children: [
            { path: '/', component: IssueShow },
          ],
        },

        { path: 'trips', component: TripsIndex },
        { path: 'trips/create', component: TripForm },
        {
          path: 'trips/:id',
          component: TripLayout,
          children: [
            { path: '/', component: TripShow },
            { path: 'edit', component: TripForm },
          ],
        },
      ],
    },
  ],
})
