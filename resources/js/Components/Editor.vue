<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { watch } from "vue";

const props = defineProps(['modelValue']);

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
  content: props.modelValue,
  extensions: [
    StarterKit,
  ],
  editorProps: {
    attributes: {
      class: 'bg-gray-600 border border-gray-200/20 shadow-slim p-2 rounded-lg focus:outline-none min-h-[10rem] transition max-w-none focus:border-primary-500 prose-p:text-gray-100 prose prose-sm prose-gray prose-invert prose-img:rounded-lg'
    }
  },
  onUpdate: ({editor}) => {
    // HTML
    emit('update:modelValue', editor.getHTML())
  },
})

watch(props.modelValue, async (newModelValue, oldModelValue) => {
  const isSame = this.editor.getHTML() === newModelValue

  if (isSame) {
    return
  }

  this.editor.commands.setContent(newModelValue, false)
});
</script>

<template>
  <editor-content :editor="editor" />
</template>