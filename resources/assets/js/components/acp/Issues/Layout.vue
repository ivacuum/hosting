<script>
import Layout from '../BaseItemLayout'
import LayoutMixin from '../../../mixins/BaseLayout'

export default {
  mixins: [LayoutMixin],
  components: { Layout },
}
</script>

<template>
<layout v-bind="{ resource, svg, extra }" @destroy="destroy"/>
</template>
