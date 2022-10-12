<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
  is: {}
});
</script>

<template>
    <component :is="is" :type="type" class="inline-flex items-center justify-center bg-gray-600 border border-gray-500/50 rounded shadow-slim p-2 font-medium text-gray-50 hover:text-white">
        <slot />
    </component>
</template>
