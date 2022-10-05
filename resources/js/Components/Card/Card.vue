<script setup>
import { defineProps } from "vue";

defineProps({
  divide: {
    type: Boolean
  }
})
</script>

<template>
  <div class="relative group rounded-lg motion-safe:transition border border-neutral-200 border-opacity-[0.15] overflow-hidden">
    <div class="relative z-20" :class="[$props.divide ? 'divide-y divide-neutral-200/5' : '']">
      <slot />
    </div>
  </div>
</template>