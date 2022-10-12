<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
  },
  value: {
    default: null,
  },
});

const proxyChecked = computed({
  get() {
    return props.checked;
  },

  set(val) {
    emit("update:checked", val);
  },
});
</script>

<template>
  <input type="checkbox" :value="value" v-model="proxyChecked"
         class="rounded bg-gray-600 border-gray-200/20 text-primary-500 shadow-slim focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
</template>
