<script setup>
import { defineProps } from "vue";

defineProps({
  image: {
    type: String
  }
})
</script>

<template>
  <div class="relative flex px-4 py-2 bg-primary-600 motion-safe:transition overflow-hidden">
    <img v-show="$props?.image" :src="$props?.image" alt="card header image" class="absolute object-center object-cover w-full h-full inset-0 opacity-75 highlight-primary-50/5" />

    <slot/>
  </div>
</template>