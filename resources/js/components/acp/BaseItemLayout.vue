<script>
export default {
  props: {
    extra: Object,
    resource: Object,
  },
}

// TODO: consider .sync for passing resource
</script>

<template>
<div v-if="resource">
  <div class="grid lg:grid-cols-4 gap-8">
    <div>
      <div class="flex flex-col w-full">
        <router-link
          class="border-l-2 border-transparent px-3 py-2"
          :to="resource.show_url"
          v-if="resource.show_url"
          active-class="border-orangeish-600 text-black hover:text-black"
          exact
        >
          {{ $t(`${extra.i18n_index}.show`) }}
        </router-link>
        <router-link
          class="border-l-2 border-transparent px-3 py-2"
          :to="resource.edit_url"
          v-if="resource.edit_url"
          active-class="border-orangeish-600 text-black hover:text-black"
        >
          {{ $t(`${extra.i18n_index}.edit`) }}
        </router-link>
        <router-link
          class="border-l-2 border-transparent px-3 py-2"
          :to="relation.path"
          v-for="relation in extra.relations"
          :key="relation.i18n_index"
          active-class="border-orangeish-600 text-black hover:text-black"
        >
          {{ $t(`${relation.i18n_index}.index`) }}
          <span class="text-muted text-xs whitespace-no-wrap">{{ relation.count | decimal }}</span>
        </router-link>
        <a
          class="border-l-2 border-transparent px-3 py-2"
          :href="resource.www"
          v-if="resource.www"
        >
          {{ $t('www') }}
          <span v-html="$root.svg.external_link"></span>
        </a>
        <a class="border-l-2 border-transparent px-3 py-2" href="#" @click.prevent="$emit('destroy')">
          {{ $t('delete') }}
        </a>
      </div>
    </div>
    <div class="lg:col-span-3">
      <slot name="header">
        <h2 class="mt-4 lg:mt-0 break-words">
          <a href="back" @click.prevent="$router.go(-1)" v-html="$root.svg.chevron_left"></a>
          <slot>{{ resource.breadcrumb }}</slot>
          <slot name="append">
            <span class="text-base text-muted" v-if="resource.id">#{{ resource.id }}</span>
          </slot>
        </h2>
      </slot>

      <router-view :resource="resource"/>
    </div>
  </div>
</div>
</template>
