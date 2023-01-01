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
    <input class="focus:appearance-none h-8 w-full items-center gap-2 rounded-lg pl-2 pr-3 text-sm ring-1 transition bg-white/5 text-gray-400 ring-inset ring-white/10 hover:ring-white/20 focus:ring-primary-500 lg:flex focus:outline-none" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
