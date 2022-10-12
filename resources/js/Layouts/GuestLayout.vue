<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Card from "@/Components/Card/Card.vue";
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900 text-base space-y-4">
        <div>
            <Link :href="route('home')">
              <img src="https://cdn.noclip.gg/ZwrHIowmadgLm2pr/oZq4yj6CzV6h5hl8FdCJpde0-xu-X8Fg.png" alt="kings" class="object-contain select-none pointer-events-none m-auto w-24 h-24 rounded" loading="lazy">
            </Link>
        </div>

      <Card class="bg-gray-800 shadow-slim p-4 w-full max-w-sm">
        <slot />
      </Card>
    </div>
</template>
