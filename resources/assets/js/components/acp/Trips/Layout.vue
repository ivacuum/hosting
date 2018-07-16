<script>
import Layout from '../BaseItemLayout'
import LayoutMixin from '../../../mixins/BaseLayout'

export default {
  mixins: [LayoutMixin],
  components: { Layout },
}
</script>

<template>
<layout v-bind="{ resource, svg, extra }" @destroy="destroy">
  <template slot="append">
    <small class="text-muted" v-html="resource.localized_date"></small>
  </template>
</layout>
</template>
