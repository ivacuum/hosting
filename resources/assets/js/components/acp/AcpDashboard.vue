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

  <div class="tw-max-w-700px tw-mx-auto">
    <quiz/>
  </div>
</div>
</template>
