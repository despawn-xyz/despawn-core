<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

const props = defineProps({
  content: String,
})

const editor = useEditor({
  content: props.content,
  editable: false,
  extensions: [
    StarterKit,
  ],
})
</script>

<template>
  <editor-content :editor="editor" />
</template>