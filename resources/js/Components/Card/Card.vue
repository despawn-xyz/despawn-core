<script setup>
import { defineProps } from "vue";

defineProps({
  divide: {
    type: Boolean
  }
})
</script>

<template>
  <div class="relative group rounded-lg bg-neutral-800 motion-safe:transition shadow-inner ring-1 ring-neutral-200 ring-opacity-[0.15] overflow-hidden">
    <div class="relative z-20" :class="[$props.divide ? 'divide-y divide-neutral-200/5' : '']">
      <slot />
    </div>
  </div>
</template>