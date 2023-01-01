<script setup>
import { defineProps } from "vue";

defineProps({
  divide: {
    type: Boolean
  }
})
</script>

<template>
  <div class="relative group motion-safe:transition overflow-hidden rounded-2xl bg-gray-900 shadow-md ring-1 ring-white/10 divide-y divide-gray-200/5">
    <slot />
  </div>
</template>