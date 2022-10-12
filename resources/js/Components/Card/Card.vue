<script setup>
import { defineProps } from "vue";

defineProps({
  divide: {
    type: Boolean
  }
})
</script>

<template>
  <div class="relative group rounded-lg motion-safe:transition border border-gray-200 border-opacity-[0.15] overflow-hidden"
       :class="[$props.divide ? 'divide-y divide-gray-200/5' : '']">
    <slot />
  </div>
</template>