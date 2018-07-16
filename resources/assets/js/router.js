/* global VueRouter */
import locale from './i18n/locale'

import Dashboard from './components/acp/AcpDashboard.vue'
import TripForm from './components/acp/Trips/Form.vue'
import TripShow from './components/acp/Trips/Show.vue'
import TripLayout from './components/acp/Trips/Layout.vue'
import TripsIndex from './components/acp/Trips/Index.vue'

export default new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',

  routes: [
    { path: `${locale}/acp`, name: 'acp', component: Dashboard },

    { path: `${locale}/acp/trips`, component: TripsIndex },
    { path: `${locale}/acp/trips/create`, component: TripForm },
    {
      path: `${locale}/acp/trips/:id`,
      component: TripLayout,
      children: [
        { path: '/', component: TripShow },
        { path: 'edit', component: TripForm },
      ],
    },
  ],
})
