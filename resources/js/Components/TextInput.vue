<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input class="bg-neutral-600 text-neutral-50 shadow-slim border border-neutral-200/20 focus:border-primary-500 transition rounded-lg" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
