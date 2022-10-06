<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center px-2 font-medium motion-safe:transition text-white/60 hover:text-white'
    : 'flex items-center px-2 font-medium motion-safe:transition text-white/60 hover:text-white'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
