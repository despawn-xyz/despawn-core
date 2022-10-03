<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

const editor = useEditor({
  content: null,
  extensions: [
    StarterKit,
  ],
})
</script>

<template>
  <editor-content :editor="editor" />
</template>