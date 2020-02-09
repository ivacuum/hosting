<script>
export default {
  components: {
    'acp-breadcrumbs': () => import(/* webpackChunkName: "acp" */'./AcpBreadcrumbs.vue'),
    'acp-menu': () => import(/* webpackChunkName: "acp" */'./AcpMenu.vue'),
  }
}
</script>

<template>
<div id="app">
  <acp-menu/>
  <acp-breadcrumbs/>

  <div class="flex-h-full">
    <div class="container my-4">
      <router-view/>
    </div>
  </div>
</div>
</template>
