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

  <div class="max-w-700px mx-auto">
    <quiz/>
  </div>
</div>
</template>
