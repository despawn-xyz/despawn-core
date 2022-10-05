<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
  board: Object
})
</script>

<template>
  <AuthenticatedLayout>
    {{ board.title }}
  </AuthenticatedLayout>
</template>