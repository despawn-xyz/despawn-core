<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Editor from "@/Components/Editor.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Card from "@/Components/Card/Card.vue";

const props = defineProps({
  board: Object
})

const form = useForm({
  title: '',
  body: null
})

const submit = () => {
  form.post(route('forums.board.thread.store', props.board));
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="space-y-4">
      <div>
        <h1 class="font-bold text-2xl text-white">
          Create a thread for: {{ $page.props.board.title }}
        </h1>
        <p class="text-gray-400">
          When creating a thread, please follow the rules for this forum.
        </p>
      </div>

      <Card class="bg-gray-800 shadow-slim p-4">
        <form @submit.prevent="submit" class="space-y-4">
          <div class="space-y-2">
            <InputLabel value="title" />
            <TextInput v-model="form.title" type="text" />
            <InputError :message="form.errors.title" />
          </div>

          <div class="space-y-2">
            <InputLabel value="body" />
            <Editor v-model="form.body" />
            <InputError :message="form.errors.body" />
          </div>

          <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Create thread
          </PrimaryButton>
        </form>
      </Card>

    </div>
  </AuthenticatedLayout>
</template>