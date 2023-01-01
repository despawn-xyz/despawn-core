<script setup>
import { defineProps } from "vue";

defineProps({
  image: {
    type: String
  }
})
</script>

<template>
  <div class="flex min-h-[calc(theme(spacing.12)+1px)] flex-wrap items-center gap-x-4 px-4 dark:bg-transparent">
<!--    <img v-show="$props?.image" :src="$props?.image" alt="card header image" class="absolute object-center object-cover w-full h-full inset-0 opacity-75 highlight-primary-50/5" />-->

    <slot/>
  </div>
</template>