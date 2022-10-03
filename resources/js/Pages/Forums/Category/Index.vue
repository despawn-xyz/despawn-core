<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
  Cateogry: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="test"/>


  </AuthenticatedLayout>
</template>