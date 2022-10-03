<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'text-base font-medium motion-safe:transition text-neutral-100 hover:text-neutral-300'
    : 'text-base font-medium motion-safe:transition text-neutral-100 hover:text-neutral-300'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
