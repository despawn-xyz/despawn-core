<script setup>
import { defineProps } from "vue"

defineProps({
  image: {
    type: String
  }
})
</script>


<template>
  <div class="absolute inset-0 z-0 w-full h-full overflow-hidden bg-gray-900">
      <div class="absolute z-10 top-0 left-0 h-28 w-full bg-gradient-to-b from-black/50 to-transparent"></div>
      <img loading="lazy" :src="$props.image" class="absolute inset-0 w-full aspect-video object-cover object-center pointer-events-none select-none opacity-40 mask-gradient" alt="cover_photo">
  </div>
</template>