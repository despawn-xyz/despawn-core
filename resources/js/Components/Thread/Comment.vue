<script setup>
import { useForm, Link} from "@inertiajs/inertia-vue3";
import StaticEditor from "@/Components/StaticEditor.vue";
import { ref } from "vue";
import Editor from "@/Components/Editor.vue";
import { ClockIcon, PencilIcon, DocumentCheckIcon, XCircleIcon } from "@heroicons/vue/20/solid";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DeleteCommentForm from "@/Components/Thread/DeleteCommentForm.vue";

const props = defineProps({
  thread: Object,
  comment: Object
})

const form = useForm({
  body: props.comment.body
})

let editing = ref(false)

const submit = () => {
  form.patch(route('forums.comment.update', [props.comment]), {
    onSuccess: () => {
      editing = false
    }
  })
}
</script>

<template>
  <article class="flex flex-col">
    <header class="flex items-center text-gray-400 py-2 p-4">
      <ClockIcon class="w-4 h-4" />

      <p class="ml-1">
        {{ $props.comment.created_at_for_humans }}

        <template v-if="$props.comment.was_recently_edited">
          - edited
        </template>
      </p>

      <Link class="ml-auto text-gray-50 hover:text-white" :href="`#${$props.comment.id}`">
        #{{ $props.comment.id }}
      </Link>
    </header>

    <div v-if="editing === false" class="prose prose-gray dark:prose-invert break-words whitespace-normal max-w-none flex-grow p-4">
      <StaticEditor :content="$props.comment.body" />
    </div>

    <form v-else @submit.prevent="submit" class="space-y-4 p-4">
      <div class="space-y-2">
        <InputLabel value="body" />
        <Editor v-model="form.body" />
        <InputError :message="form.errors.body" />
      </div>

      <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        <DocumentCheckIcon class="w-4 h-4 mr-2" />
        Update Comment
      </PrimaryButton>
    </form>

    <footer class="p-4 flex col-span-full border-t border-gray-200/5">
      <div class="ml-auto flex items-center space-x-2">
        <button v-if="editing" type="button" @click="editing = false" class="flex items-center justify-center bg-gray-600 border border-gray-200/20 rounded shadow-slim p-2 font-medium text-gray-50 hover:text-white">
          <XCircleIcon class="w-4 h-4 mr-2" />
          Cancel
        </button>

        <template v-else>
          <button type="button" @click="editing = true" class="flex items-center justify-center bg-gray-600 border border-gray-200/20 rounded shadow-slim p-2 font-medium text-gray-50 hover:text-white">
            <PencilIcon class="w-4 h-4 mr-2" />
            Edit Comment
          </button>

          <DeleteCommentForm :comment="$props.comment" />
        </template>
      </div>
    </footer>
  </article>
</template>