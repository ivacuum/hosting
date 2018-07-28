<script>
export default {
  components: {
    'acp-breadcrumbs': () => import(/* webpackChunkName: "acp" */'./acp/AcpBreadcrumbs.vue'),
    'acp-menu': () => import(/* webpackChunkName: "acp" */'./acp/AcpMenu.vue'),
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
