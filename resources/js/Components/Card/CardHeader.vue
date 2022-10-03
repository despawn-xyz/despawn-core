<script setup>
import { defineProps } from "vue";

defineProps({
  image: {
    type: String
  }
})
</script>

<template>
  <div class="relative flex p-4 bg-neutral-900/20 motion-safe:transition overflow-hidden border-b border-neutral-200/5">
    <img v-show="$props.image" :src="$props.image" class="absolute object-center object-cover w-full h-full inset-0 opacity-75 highlight-primary-50/5" />

    <slot/>
  </div>
</template>