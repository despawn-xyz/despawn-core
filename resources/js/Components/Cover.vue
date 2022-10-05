<script setup>
import { defineProps } from "vue"

defineProps({
  image: {
    type: String
  }
})
</script>


<template>
  <div></div>
<!--  <div class="absolute z-0 w-full h-full overflow-hidden">-->
<!--    <div class="absolute z-10 top-0 left-0 h-28 w-full bg-gradient-to-b from-black/50 to-transparent"></div>-->
<!--    <img loading="lazy" :src="$props.image" class="absolute inset-0 w-full aspect-video object-cover object-center pointer-events-none select-none opacity-60 mask-gradient" alt="cover_photo">-->

<!--    <div class="hidden dark:block absolute z-10 top-0 inset-x-0 h-full" style="background-image: linear-gradient(0deg, rgb(var(&#45;&#45;neutral-900)) 25%, rgba(0, 0, 0, 0) 100%);"></div>-->
<!--  </div>-->
</template>