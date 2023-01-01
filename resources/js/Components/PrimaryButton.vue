<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-full py-1 px-3 bg-primary-400/10 text-primary-500 ring-1 ring-inset ring-primary-500/20 hover:bg-primary-500/10 hover:text-primary-500 hover:ring-primary-400">
        <slot />
    </button>
</template>
