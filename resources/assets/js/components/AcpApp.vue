<script>
import AcpBreadcrumbs from './acp/AcpBreadcrumbs.vue'
import AcpMenu from './acp/AcpMenu.vue'

export default {
  components: {
    AcpBreadcrumbs,
    AcpMenu,
  }
}
</script>

<template>
<div id="app">
  <acp-menu/>
  <acp-breadcrumbs/>

  <div class="container-flex">
    <div class="container my-3">
      <router-view/>
    </div>
  </div>
</div>
</template>
