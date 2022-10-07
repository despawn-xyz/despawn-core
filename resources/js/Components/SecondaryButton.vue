<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center justify-center bg-neural-600 border border-neural-500/50 rounded shadow-slim p-2 font-medium text-neural-50 hover:text-white">
        <slot />
    </button>
</template>
