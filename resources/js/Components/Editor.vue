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
      class: 'bg-neutral-600 border border-neutral-200/20 shadow-slim p-2 rounded-lg focus:border-primary-500 prose-p:text-neutral-100 prose prose-sm prose-neutral prose-invert focus:outline-none min-h-[10rem] transition'
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