<script setup>
import { router } from '@inertiajs/vue3';
defineProps({
  links: Array,
  preserveState: {
    type: Boolean,
    default: false,
  },
})

</script>

<template>
  <div class="mt-6 -mb-1 flex flex-wrap justify-center">
    <template v-for="(link, key) in links" :key="key">
      <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400"
        :class="{ 'ml-auto': link.label === 'Next' }" v-html="link.label"></div>
      <button v-else  @click="router.visit(link.url, {preserveState: preserveState, preserveScroll:true})" :key="key"
        class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
        :class="{ 'bg-indigo-200': link.active, 'ml-auto': link.label === 'Next' }" v-html="link.label">      
      </button>
  </template>
</div></template>