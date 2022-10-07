<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center justify-center bg-danger-600 border border-danger-500/50 rounded shadow-slim p-2 font-medium text-danger-50 hover:text-white">
        <slot />
    </button>
</template>
