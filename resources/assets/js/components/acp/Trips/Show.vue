<script>
export default {
  props: {
    resource: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      model: {},
    }
  },
}
</script>

<template>
<div v-if="resource">
  <div>
    <a class="btn btn-default" :href="resource.new_photo_url">Добавить фотографии</a>
  </div>
  <div class="mt-3" v-if="resource.meta_image">
    <img class="img-fluid rounded" :src="resource.meta_image">
  </div>
</div>
</template>
