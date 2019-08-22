<script>
export default {
  components: {
    'quiz': () => import(/* webpackChunkName: "trainers" */'../trainer/Quiz.vue'),
  }
}
</script>

<template>
<div>
  <div>AcpDashboard Inc.</div>

  <div class="mw-700 tw-mx-auto">
    <quiz/>
  </div>
</div>
</template>
