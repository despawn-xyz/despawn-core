<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
  thread: Object
})
</script>

<template>
  <AuthenticatedLayout>
    {{ $page.props.thread.title }}
  </AuthenticatedLayout>
</template>